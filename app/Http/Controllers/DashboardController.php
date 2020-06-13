<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/16/2017
 * Time: 4:29 PM
 */

namespace App\Http\Controllers;


use App\Mail\UserRegister;
use App\Repositories\ClientRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Support\TaskSupport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    protected $client;
    protected $product;
    protected $task;
    protected $support;
    protected $user;

    /**
     * DashboardController constructor.
     * @param ClientRepository $client_repository
     * @param ProductRepository $product_repository
     * @param TaskRepository $task_repository
     * @param TaskSupport $task_support
     */
    function __construct(ClientRepository $client_repository, ProductRepository $product_repository, TaskRepository $task_repository, TaskSupport $task_support, UserRepository $user_repository)
    {
        $this->middleware('auth');
        $this->middleware('web_admin');
        $this->product = $product_repository;
        $this->client = $client_repository;
        $this->task = $task_repository;
        $this->support = $task_support;
        $this->user = $user_repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->product->getDashboardProducts();

        $tasks = $this->support->getTaskAlerts();

        $inventory = $this->product->getInventory();

        $annual_from_date = Carbon::now()->subYear()->subDays(3)->format('Y-m-d');

        $annual_to_date = Carbon::now()->subYear()->addDays(4)->format('Y-m-d');

        $client_reminder_annual = $this->user->getClientReminder($annual_from_date, $annual_to_date);

        $biannual_from_date = Carbon::now()->subMonths(6)->subDays(3)->format('Y-m-d');

        $biannual_to_date = Carbon::now()->subMonths(6)->addDays(4)->format('Y-m-d');

        $client_reminder_biannual = $this->user->getClientReminder($biannual_from_date, $biannual_to_date);

        $quarter_from_date = Carbon::now()->subMonths(3)->subDays(3)->format('Y-m-d');

        $quarter_to_date = Carbon::now()->subMonths(3)->addDays(4)->format('Y-m-d');

        $client_reminder_quarter = $this->user->getClientReminder($quarter_from_date, $quarter_to_date);

        $client_reminder = [];

        foreach ($client_reminder_annual as $client_reminder_annual_item) {
            $client_reminder[] = $client_reminder_annual_item;
        }

        foreach ($client_reminder_biannual as $client_reminder_biannual_item) {
            $client_reminder[] = $client_reminder_biannual_item;
        }

        foreach ($client_reminder_quarter as $client_reminder_quarter_item) {
            $client_reminder[] = $client_reminder_quarter_item;
        }

        foreach ($tasks as $task) {
            $task->start_day = Carbon::parse($task->schedule_start_time)->format('jS');
            $task->start_month = Carbon::parse($task->schedule_start_time)->format('M');
            $task->start_year = Carbon::parse($task->schedule_start_time)->format('Y');
            $task->schedule_start_date = Carbon::parse($task->schedule_start_time)->format('Y-m-d');
            $task->due = Carbon::parse($task->schedule_start_time)->diffForHumans();
            $task->notification_type = 'task';
            $cleaner = $this->task->getCurrentCleanerFromTask($task->task_id);

            if ($cleaner) {
                $task->cleaner = $this->user->getCleaner($cleaner->cleaner_id);
            } else {
                $task->cleaner = ['first_name' => '', 'last_name' => ''];
            }

            if (Carbon::parse($task->schedule_start_time)->format('Y-m-d') == Carbon::now()->format('Y-m-d')) {
                $task->today = true;
            } else {
                $task->today = false;
            }
        }

        $sounds = $this->task->getAudio();

        foreach ($sounds as $sound) {
            $sound->task_items = $this->task->getIncompleteItems($sound->task_id);
            $sound->start_day = Carbon::parse($sound->cleaner_start_time)->format('jS');
            $sound->start_month = Carbon::parse($sound->cleaner_start_time)->format('M');
            $sound->start_year = Carbon::parse($sound->cleaner_start_time)->format('Y');
            $sound->notification_type = 'sound';
            //$sound->audio = config('STORAGE_URL') . $sound->audio;
            //http://fbm.com/app/
            // dd(config('STORAGE_URL'));
            $sound->audio = 'http://fbm.com/app/' . $sound->audio;
            $sound->task = $this->task->getTask($sound->task_id);
        }

        foreach ($inventory as $inventory_item) {
            if ($inventory_item->shortage_alert > $inventory_item->qty) {
                $inventory_item->shortage = true;
            } else {
                $inventory_item->shortage = false;
            }
        }

        return view('page.dashboard', [
            'products' => $products,
            'tasks' => $tasks,
            'inventory' => $inventory,
            'today' => Carbon::now()->format('Y-m-d'),
            'client_reminder' => $client_reminder,
            'sounds' => $sounds
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchPost(Request $request)
    {
        $user_id = Auth::id();

        $admin = $this->user->getAdminByUser($user_id);

        $query = $request->keyword;

        $search_result = $this->user->searchMenus($query, $admin->level);

        return view('page.search', ['search_result' => $search_result]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearNotification(Request $request)
    {
        $task_id = $request->task_id;
        $this->task->updateNotification($task_id, false);

        $tasks = $this->support->getTaskAlerts();

        foreach ($tasks as $task) {
            $task->start_day = Carbon::parse($task->schedule_start_time)->format('jS');
            $task->start_month = Carbon::parse($task->schedule_start_time)->format('M');
            $task->start_year = Carbon::parse($task->schedule_start_time)->format('Y');
            $task->schedule_start_date = Carbon::parse($task->schedule_start_time)->format('Y-m-d');
            $task->due = Carbon::parse($task->schedule_start_time)->diffForHumans();
        }

        return response()->json($tasks);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function clearSound(Request $request)
    {
        $audio_id = $request->audio_id;
        $this->task->updateSound($audio_id, false);
        return response()->json(['message' => 'Success']);
    }

    /**
     *
     */
    public function test()
    {
        $audio = DB::select(DB::raw("select * from cleaner_schedule_audio"));

        $file = $audio[count($audio) - 1]->audio;

        $decoded = base64_decode($file);
        $file_name = 'file.m4a';
        file_put_contents($file_name, $decoded);

        if (file_exists($file_name)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_name));
            readfile($file_name);
            exit;
        }

    }
}