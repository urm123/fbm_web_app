<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/9/2018
 * Time: 12:18 PM
 */

namespace App\Http\Controllers;

use App\Repositories\ClientFollowupRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ClientFollowupsController
 * @package App\Http\Controllers
 */
class WebClientFollowupsController extends Controller
{

    protected $client_followup;

    protected $user;

    protected $task;

    /**
     * WebClientFollowupsController constructor.
     * @param ClientFollowupRepository $client_followup_repository
     * @param UserRepository $user_repository
     * @param TaskRepository $task_repository
     */
    function __construct(ClientFollowupRepository $client_followup_repository, UserRepository $user_repository, TaskRepository $task_repository)
    {
        $this->client_followup = $client_followup_repository;
        $this->user = $user_repository;
        $this->task = $task_repository;
        $this->middleware('auth');
        $this->middleware('web_admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function clientFollowups()
    {
        $now = Carbon::now();
        $start_time = $now->format('Y-m') . '-01 00:00:00';
        $end_time = $now->format('Y-m') . '-31 12:00:00';
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);
        $dates = [];

        $date = $start;
        while ($date <= $end) {
            $dates[] = clone $date;
            $date->addDay();
        }

        $tasks = [];
        foreach ($dates as $date) {
            $task = $this->task->getFollowupOneTimeTasks($date->format('Y-m-d'));
            if ($task) {
                $tasks[] = $task;
            }
        }
        $linear_tasks = [];

        foreach ($tasks as $task) {
            foreach ($task as $item) {
                $item->client_followup_id = 'new';
                $item->date = Carbon::parse($item->date)->format('Y-m-d');
                $item->updated_at = Carbon::parse($item->updated_at)->format('Y-m-d');
                $linear_tasks[] = $item;
            }
        }
        $repeated_tasks = $this->task->getFollowupRepeatedTasks();

        foreach ($repeated_tasks as $repeated_task) {
            $repeated_task->client_followup_id = 'new';
            $repeated_task->date = Carbon::parse($repeated_task->date)->format('Y-m-d');
            $repeated_task->updated_at = Carbon::parse($repeated_task->updated_at)->format('Y-m-d');
            $linear_tasks[] = $repeated_task;
        }
        $client_followups = $this->client_followup->getClientFollowups($start_time, $end_time);

        foreach ($client_followups as $client_followup) {
            $client_followup->date = Carbon::parse($client_followup->date)->format('Y-m-d');
            $client_followup->updated_at = Carbon::parse($client_followup->updated_at)->format('Y-m-d');

            foreach ($linear_tasks as $key => $linear_task) {
                if ($linear_task->client_id == $client_followup->client_id && $client_followup->task_id) {
                    array_splice($linear_tasks, $key - count($linear_tasks), 1);
                }
            }
            $linear_tasks[] = $client_followup;
        }
        return view('page.client-followups.client-followups', ['client_followups' => $linear_tasks, 'tasks' => $linear_tasks]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFollowup(Request $request)
    {
        $followup_id = $request->followup_id;
        $now = Carbon::now();
        $start_time = $now->format('Y-m') . '-01 00:00:00';
        $end_time = $now->format('Y-m') . '-31 12:00:00';
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);
        $dates = [];

        $date = $start;
        while ($date <= $end) {
            $dates[] = clone $date;
            $date->addDay();
        }

        $tasks = [];
        foreach ($dates as $date) {
            $task = $this->task->getFollowupOneTimeTasks($date->format('Y-m-d'));
            if ($task) {
                $tasks[] = $task;
            }
        }
        $linear_tasks = [];

        foreach ($tasks as $task) {
            foreach ($task as $item) {
                $item->client_followup_id = 'new';
                $item->date = Carbon::parse($item->date)->format('Y-m-d');
                $item->updated_at = Carbon::parse($item->updated_at)->format('Y-m-d');
                $linear_tasks[] = $item;
            }
        }
        $repeated_tasks = $this->task->getFollowupRepeatedTasks();

        foreach ($repeated_tasks as $repeated_task) {
            $repeated_task->client_followup_id = 'new';
            $repeated_task->date = Carbon::parse($repeated_task->date)->format('Y-m-d');
            $repeated_task->updated_at = Carbon::parse($repeated_task->updated_at)->format('Y-m-d');
            $linear_tasks[] = $repeated_task;
        }
        $client_followups = $this->client_followup->getClientFollowups($start_time, $end_time);

        foreach ($client_followups as $client_followup) {
            $client_followup->date = Carbon::parse($client_followup->date)->format('Y-m-d');
            $client_followup->updated_at = Carbon::parse($client_followup->updated_at)->format('Y-m-d');

            foreach ($linear_tasks as $key => $linear_task) {
                if ($linear_task->client_id == $client_followup->client_id && $client_followup->task_id) {
                    array_splice($linear_tasks, $key - count($linear_tasks), 1);
                }
            }
            $linear_tasks[] = $client_followup;
        }
        return view('page.client-followups.open-followup', ['client_followups' => $linear_tasks, 'followup_id' => $followup_id]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNew()
    {
        $clients = $this->user->getClients();
        return view('page.client-followups.add-new', ['clients' => $clients]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddNew(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'client' => 'required',
            'type' => 'required',
            'comment' => 'string',
            'date' => 'date',
        ], $messages);

        $client = $request->client;
        $type = $request->type;
        $comment = $request->comment;
        $date = $request->date;

        $admin = $this->user->getAdminByUser(Auth::id());
        $client_followup = $this->client_followup->createClientFollowup($client, $admin->id, $type, $comment, $date);
        return redirect('client-followups')->with(['success' => 'Saved successfully']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetClientFollowupComments(Request $request)
    {
        $client_followup_id = $request->client_followup_id;

        $client_followup_comments = $this->client_followup->getClientFollowupComments($client_followup_id);

        foreach ($client_followup_comments as $client_followup_comment) {
            $client_followup_comment->created_by = $client_followup_comment->first_name . ' ' . $client_followup_comment->last_name;
        }

        return response()->json(['client_followup_comments' => $client_followup_comments]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSaveClientFollowupComments(Request $request)
    {
        $client_followup_id = $request->client_followup_id;
        $date = $request->date;
        $comment = $request->comment;
        $description = $request->description;
        $task_id = $request->task_id;

        $admin = $this->user->getAdminByUser(Auth::id());

        if (isset($request->upload)) {
            $upload_file = $request->upload;
            $upload = $upload_file->store('client-followups');
        } else {
            $upload = '';
        }

        if ($client_followup_id == 'new') {
            $task = $this->task->getTaskDetails($task_id);
            $client_followup = $this->client_followup->createClientFollowup($task[0]->client_id, $admin->id, 'Service Feedback', 'Service Feedback', $date, $task_id);
            $client_followup_comment = $this->client_followup->createClientFollowupComment($client_followup->id, $admin->id, $date, $upload, $comment, $description);
        } else {
            $client_followup_comment = $this->client_followup->createClientFollowupComment($client_followup_id, $admin->id, $date, $upload, $comment, $description);
            $this->client_followup->updateClientFollowupTimeStamp($client_followup_id);
        }

        return response()->json(['client_followup_comment' => $client_followup_comment]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxEndClientFollowup(Request $request)
    {
        $client_followup_id = $request->client_followup_id;
        $task_id = $request->task_id;
        if ($client_followup_id == 'new') {
            $admin = $this->user->getAdminByUser(Auth::id());
            $task = $this->task->getTaskDetails($task_id);
            $date = Carbon::now()->format('Y-m-d');
            $client_followup = $this->client_followup->createClientFollowup($task[0]->client_id, $admin->id, 'Service Feedback', 'Service Feedback', $date, $task_id);
            $end_client_followup = $this->client_followup->endClientFollowup($client_followup->id);
        } else {
            $end_client_followup = $this->client_followup->endClientFollowup($client_followup_id);
        }
        if ($end_client_followup) {
            return response()->json(['message' => 'Success'], 200);
        }
    }

    public function ajaxCreateTicket()
    {

    }
}