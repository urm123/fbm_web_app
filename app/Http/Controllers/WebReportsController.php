<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/8/2018
 * Time: 4:38 PM
 */

namespace App\Http\Controllers;


use App\Repositories\CategoryRepository;
use App\Repositories\ChecklistRepository;
use App\Repositories\ClientRepository;
use App\Repositories\FeedbackRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Support\CleanersExport;
use App\Support\ClientsExport;
use App\Support\ComplaintsExport;
use App\Support\InspectorsExport;
use App\Support\StoreExport;
use App\Support\TasksExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class WebReportsController
 * @package App\Http\Controllers
 */
class WebReportsController extends Controller
{
    protected $user;
    protected $product;
    protected $feedback;
    protected $task;
    protected $checklist;
    protected $category;
    protected $client;

    /**
     * WebReportsController constructor.
     * @param UserRepository $user_repository
     * @param ProductRepository $product_repository
     * @param FeedbackRepository $feedback_repository
     * @param TaskRepository $task_repository
     * @param ChecklistRepository $checklist_repository
     */
    function __construct(
        UserRepository $user_repository,
        ProductRepository $product_repository,
        FeedbackRepository $feedback_repository,
        TaskRepository $task_repository,
        ChecklistRepository $checklist_repository,
        CategoryRepository $categoryRepository,
        ClientRepository $clientRepository
    )
    {
        $this->user = $user_repository;
        $this->product = $product_repository;
        $this->feedback = $feedback_repository;
        $this->task = $task_repository;
        $this->checklist = $checklist_repository;
        $this->category = $categoryRepository;
        $this->client = $clientRepository;
        $this->middleware('auth');
        $this->middleware('web_admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store()
    {
        $clients = $this->user->getClientsForStoreReport();

        $inventory = $this->product->getStoreInventory();

        $dates = $this->product->getInventoryDates();

        return view('page.reports.store', ['clients' => $clients, 'inventory' => json_encode($inventory), 'dates' => $dates]);
    }

    /**
     * @param StoreExport $store_export
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function storeDownload(StoreExport $store_export)
    {
        return Excel::download($store_export, 'store.xlsx');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function clients()
    {


        $cleaners = $this->user->getCleanersForReports();
        $clients = $this->user->getClientsForReports();
        $inspectors = $this->user->getInspectorsForReports();
        $categories = $this->category->getCategories();
        $cities = $this->client->getCities();


        return view('page.reports.clients', [
            'clients' => $clients,
            'inspectors' => $inspectors,
            'cleaners' => $cleaners,
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }

    /**
     * @param ClientsExport $clients_export
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function clientsDownload(ClientsExport $clients_export)
    {
        return Excel::download($clients_export, 'clients.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clientsFilter(Request $request)
    {
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request->to_date . ' 23:59:59')->format('Y-m-d H:i:s');
        $client = $request->client;
        $cleaner = $request->cleaner;
        $inspector = $request->inspector;
        $category = $request->category;
        $continuous = $request->continuous;
        $city = $request->city;

        $condition = '';

        if ($client != '') {
            $condition .= " AND clients.id = " . $client;
        }

        if ($cleaner != '') {
            $condition .= " AND cleaners.id = " . $cleaner;
        }

        if ($inspector != '') {
            $condition .= " AND inspectors.id = " . $inspector;
        }
        if ($category != '') {
            $condition .= " AND category_id = " . $category;
        }
        if ($continuous != '') {
            $condition .= " AND continuous is " . $continuous;
        }
        if ($city != '') {
            $condition .= " AND clients.city like '" . $city . "'";
        }


        $results = $this->user->getClientsForClientsReports($from_date, $to_date, $condition);

        foreach ($results as $client) {
            $client->task_items = $this->task->getTaskItemsForTasks($client->task_id);
            $inspector_feedback = $this->checklist->getLastInspectionDetails($client->client_id);

            if ($inspector_feedback) {
                $client->inspector_feedback = $inspector_feedback[0];
                $client->inspector_feedback->last_date = Carbon::parse($client->inspector_feedback->last_date)->toFormattedDateString();
            } else {
                $client->inspector_feedback = [];
            }
            $client->cleaner_rating = $this->checklist->getCleanerRatingForClient($client->client_id, $client->cleaner_id);

            if ($client->cleaner_rating[0]->count > 0) {
                $client->cleaner_rating_total = number_format($client->cleaner_rating[0]->sum / $client->cleaner_rating[0]->count, 2, '.', '');
            } else {
                $client->cleaner_rating_total = 0;
            }

            $start_time = Carbon::parse($client->start_time);

            if ($client->repeat && strpos($client->repeat_mode, '_') !== false) {
                $repeat_modes = explode('_', $client->repeat_mode);
                $repeat_text = '';
                foreach ($repeat_modes as $repeat_mode) {
                    if ($repeat_mode != '') {
                        switch ($repeat_mode) {
                            case '0':
                                $repeat_text .= 'Sunday, ';
                                break;
                            case '1':
                                $repeat_text .= 'Monday, ';
                                break;
                            case '2':
                                $repeat_text .= 'Tuesday, ';
                                break;
                            case '3':
                                $repeat_text .= 'Wednesday, ';
                                break;
                            case '4':
                                $repeat_text .= 'Thursday, ';
                                break;
                            case '5':
                                $repeat_text .= 'Friday, ';
                                break;
                            case '6':
                                $repeat_text .= 'Saturday, ';
                                break;
                            default:
                                break;
                        }
                    }
                }
                $client->repeat_mode = $repeat_text . ' ' . $start_time->format('g:iA');
            } else if ($client->repeat) {
                switch ($client->repeat_mode) {
                    case 'weekly':
                        $client->repeat_mode = 'Weekly, ' . $start_time->format('l g:iA');
                        break;
                    case 'monthly':
                        $client->repeat_mode = 'Monthly, ' . $start_time->format('jS g:iA');
                        break;
                    case 'annually':
                        $client->repeat_mode = 'Annually, ' . $start_time->format('jS F g:iA');
                        break;
                    default:
                        break;
                }
            } else {
                $client->repeat_mode = false;
                $client->start_time = $start_time->toDayDateTimeString();
            }

//            new code

            $task_items = $this->task->getTaskItems($client->task_id);

            $cleaner_schedule = $this->task->getCleanerSchedule($client->task_id, Carbon::parse($from_date)->toDateString());

            if (count($cleaner_schedule)) {
                $task_item_status = $this->task->getTaskItemStatus($cleaner_schedule[0]->id);

                foreach ($task_items as $task_item) {
                    $finished = false;
                    foreach ($task_item_status as $status) {
                        if ($task_item->id == $status->task_item_id) {
                            if ($status->status == "FINISHED") {
                                $finished = true;
                            }
                        }
                    }

                    $task_item->status = $finished;
                }

                $client->task_items = $task_items;
            } else {
                $client->task_items = $task_items;
            }

            $client->complete_count = 0;
            $client->incomplete_count = 0;

            foreach ($client->task_items as $task_item) {
                if ($task_item->status) {
                    $client->complete_count++;
                } else {
                    $client->incomplete_count++;
                }
            }

//            new code

        }

        return response()->json(['results' => $results]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complaints()
    {
        $cleaners = $this->user->getCleanersForReports();
        $clients = $this->user->getClientsForReports();
        $inspectors = $this->user->getInspectorsForReports();
        return view('page.reports.complaints', ['clients' => $clients, 'inspectors' => $inspectors, 'cleaners' => $cleaners]);
    }

    /**
     * @param ComplaintsExport $complaints_export
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function complaintsDownload(ComplaintsExport $complaints_export)
    {
        return Excel::download($complaints_export, 'complaints.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function complaintsFilter(Request $request)
    {
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request->to_date . ' 23:59:59')->format('Y-m-d H:i:s');
        $client = $request->client;
        $cleaner = $request->cleaner;
        $inspector = $request->inspector;
        $status = $request->status;

        $condition = '';

        if ($client != '') {
            $condition .= " AND clients.id = " . $client;
        }

        if ($cleaner != '') {
            $condition .= " AND cleaners.id = " . $cleaner;
        }

        if ($inspector != '') {
            $condition .= " AND inspectors.id = " . $inspector;
        }

        if ($status != '') {
            $condition .= " AND complaints.resolved is " . $status;
        }
        $complaints = $this->feedback->getComplaintsForReports($from_date, $to_date, $condition);

        foreach ($complaints as $complaint) {

            $complaint->status = 'Pending';


            $complaint->images = $this->feedback->getComplaintImages($complaint->id);
            $complaint->audio = $this->feedback->getComplaintAudio($complaint->id);
            $complaint->videos = $this->feedback->getComplaintVideo($complaint->id);

            $complaint->task = $this->task->getTaskByName($complaint->ticket);

            if ($complaint->task) {
                $complaint->task->task_items = $this->task->getTaskItems($complaint->task->id);

                $clenaer_schedule = $this->task->getCleanerScheduleForComplaint($complaint->task->id);

                if (count($clenaer_schedule)) {
                    $complaint->status = 'Completed By Cleaner';
                }

            }

            if ($complaint->resolved) {
                $complaint->status = 'Approved By Admin';
            }

            foreach ($complaint->images as $image) {
                $image->path = config('STORAGE_URL') . $image->path;
            }

            foreach ($complaint->audio as $clip) {
                $clip->path = config('STORAGE_URL') . $clip->path;
            }
            foreach ($complaint->videos as $video) {
                $video->path = config('STORAGE_URL') . $video->path;
            }
        }

        return response()->json(['complaints' => $complaints]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followups()
    {
        $clients = $this->user->getClientsForReports();
        $admins = $this->user->getAdministrators();
        return view('page.reports.followups', ['admins' => $admins, 'clients' => $clients]);
    }

    /**
     * @param ComplaintsExport $complaints_export
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function followupsDownload(ComplaintsExport $complaints_export)
    {
        return Excel::download($complaints_export, 'complaints.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function followupsFilter(Request $request)
    {
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request->to_date . ' 23:59:59')->format('Y-m-d H:i:s');
        $client = $request->client;
        $admin = $request->admin;

        $condition = '';

        if ($client != '') {
            $condition .= " AND clients.id = " . $client;
        }

        if ($admin != '') {
            $condition .= " AND followup_admin.id = " . $admin;
        }

        $followups = $this->feedback->getClientFollowupsForReport($from_date, $to_date, $condition);

        return response()->json(['followups' => $followups]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cleaners()
    {
        $clients = $this->user->getClientsForReports();
        $cleaners = $this->user->getCleanersForReports();

        return view('page.reports.cleaners', ['clients' => $clients, 'cleaners' => $cleaners]);
    }

    /**
     * @param CleanersExport $cleaners_export
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function cleanersDownload(CleanersExport $cleaners_export)
    {
        return Excel::download($cleaners_export, 'cleaners.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cleanersFilter(Request $request)
    {
        $cleaner = $request->cleaner;
        $client = $request->client;
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request->to_date . ' 23:59:59')->format('Y-m-d H:i:s');
        $absent = $request->absent;

        $conditions = '';

        if ($cleaner != '') {
            $conditions .= " AND cleaners.id=" . $cleaner;
        }

        if ($client != '') {
            $conditions .= " AND clients.id=" . $client;
        }

        if ($absent != '') {
            if ($absent == 'true') {
                $conditions .= ' and cleaner_schedules.start_time is null and cleaner_schedules.end_time is null ';
            } else {
                $conditions .= ' and cleaner_schedules.start_time is not null or cleaner_schedules.end_time is not null ';
            }
        }

        $seconds = 0;

        $clients = $this->user->getCleanerClientDetails($from_date, $to_date, $conditions);

        foreach ($clients as $client) {
            $client->absent = false;
            if ($client->working_hours != '') {
                $time = explode(':', $client->working_hours);
                $seconds += (int)$time[0] * 3600 + (int)$time[1] * 60 + (int)$time[2];
            } else {
                if ($client->cleaner_start_time == '' && $client->cleaner_end_time == '') {
                    $client->absent = true;
                }
            }

            if ($client->deleted != '') {
                $client->deleted = 'Terminated. For: ' . $client->reason;
            } else {
                $client->deleted = 'Active';
            }

            $task_items = $this->task->getTaskItems($client->task_id);
            if ($client->cleaner_schedule_id) {
                $task_item_status = $this->task->getTaskItemStatus($client->cleaner_schedule_id);

                foreach ($task_items as $task_item) {
                    $finished = false;
                    foreach ($task_item_status as $status) {
                        if ($task_item->id == $status->task_item_id) {
                            if ($status->status == "FINISHED") {
                                $finished = true;
                            }
                        }
                    }

                    $task_item->status = $finished;
                }

                $client->task_items = $task_items;
            } else {
                $client->task_items = $task_items;
            }

            $client->complete_count = 0;
            $client->incomplete_count = 0;

            foreach ($client->task_items as $task_item) {
                if ($task_item->status) {
                    $client->complete_count++;
                } else {
                    $client->incomplete_count++;
                }
            }

            if ($client->cleaner_schedule_id) {
                $client->audio = $this->task->getAudioByCleanerSchedule($client->cleaner_schedule_id);
            } else {
                $client->audio = [];
            }

            $cleaner_rating = $this->checklist->getCleanerRatingByClient($client->cleaners_id, $client->client_id);

            if ($cleaner_rating[0]->count > 0) {
                $client->rating = number_format($cleaner_rating[0]->sum / $cleaner_rating[0]->count, 0, '.', '');
            } else {
                $client->rating = 0;
            }

            $client->complaints = $this->feedback->getComplaintsForTasksClients($client->task_id, $client->cleaners_id);
        }

        $hours = (int)($seconds / 3600);

        $hour_remainder = $seconds % 3600;

        $minutes = (int)($hour_remainder / 60);

        $minute_remainder = $hour_remainder % 60;

        $total = $hours . ':' . $minutes . ':' . $minute_remainder;

        return response()->json(['clients' => $clients, 'total' => $total]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inspectors()
    {
        $clients = $this->user->getClientsForReports();
        $inspectors = $this->user->getInspectorsForReports();

        return view('page.reports.inspectors', ['clients' => $clients, 'inspectors' => $inspectors]);
    }

    /**
     * @param InspectorsExport $inspectors_export
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function inspectorsDownload(InspectorsExport $inspectors_export)
    {
        return Excel::download($inspectors_export, 'inspectors.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function inspectorFilter(Request $request)
    {
        $inspector = $request->inspector;
        $client = $request->client;
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request->to_date . ' 23:59:59')->format('Y-m-d H:i:s');
        $absent = $request->absent;
        $inspectorLevel = $request->inspectorLevel;

        $conditions = '';

        if ($inspector != '') {
            $conditions .= " AND inspectors.id=" . $inspector;
        }

        if ($client != '') {
            $conditions .= " AND clients.id=" . $client;
        }
        if ($inspectorLevel != '') {
            $conditions .= " AND inspectors.level='" . $inspectorLevel . "'";
        }
        if ($absent != '') {
            if ($absent == 'true') {
                $conditions .= ' and inspector_schedules.start_time is null and inspector_schedules.end_time is null ';
            } else {
                $conditions .= ' and inspector_schedules.start_time is not null or inspector_schedules.end_time is not null ';
            }
        }

        $clients = $this->user->getInspectorClientDetails($from_date, $to_date, $conditions);

        $seconds = 0;

        foreach ($clients as $client) {
            $client->absent = false;
            if ($client->working_hours != '') {
                $time = explode(':', $client->working_hours);
                $seconds += (int)$time[0] * 3600 + (int)$time[1] * 60 + (int)$time[2];
            } else {
                if ($client->inspector_start_time == '' && $client->inspector_end_time == '') {
                    $client->absent = true;
                }
            }

            if ($client->deleted != '') {
                $client->deleted = 'Terminated. For: ' . $client->reason;
            } else {
                $client->deleted = 'Active';
            }

            $inspector_feedback = $this->checklist->getLastTaskInspectionDetails($client->task_id);

            if ($inspector_feedback) {
                $client->inspector_feedback = $inspector_feedback[0];
                $client->inspector_feedback->last_date = Carbon::parse($client->inspector_feedback->last_date)->toFormattedDateString() . ' ' . Carbon::parse($client->inspector_feedback->last_date)->format('g:iA');
            } else {
                $client->inspector_feedback = [];
            }

        }

        $hours = (int)($seconds / 3600);

        $hour_remainder = $seconds % 3600;

        $minutes = (int)($hour_remainder / 60);

        $minute_remainder = $hour_remainder % 60;

        $total = $hours . ':' . $minutes . ':' . $minute_remainder;


        return response()->json(['clients' => $clients, 'total' => $total]);

    }

    /**
     *
     */
    public function payments()
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tasks()
    {
        $clients = $this->user->getClientsForReports();
        $cleaners = $this->user->getCleanersForReports();
        $inspectors = $this->user->getInspectorsForReports();

        return view('page.reports.tasks', ['clients' => $clients, 'cleaners' => $cleaners, 'inspectors' => $inspectors]);
    }

    /**
     * @param TasksExport $tasks_export
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function tasksDownload(TasksExport $tasks_export)
    {
        return Excel::download($tasks_export, 'tasks.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tasksFilter(Request $request)
    {
        $cleaner = $request->cleaner;
        $client = $request->client;
        $inspector = $request->inspector;
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request->to_date . ' 23:59:59')->format('Y-m-d H:i:s');

        $conditions = '';

        if ($cleaner != '') {
            $conditions .= " AND cleaners.id=" . $cleaner;
        }

        if ($client != '') {
            $conditions .= " AND clients.id=" . $client;
        }

        if ($inspector != '') {
            $conditions .= " AND inspectors.id=" . $inspector;
        }


        $clients = $this->user->getClientTasksDetails($from_date, $to_date, $conditions);

        foreach ($clients as $client) {


            $check_completed = $this->task->checkCompleted($client->task_id);

            if ($check_completed) {
                $client->task_status = 'COMPLETED';
            } else {
                $client->task_status = 'INCOMPLETE';
            }


            $sub_tasks = $this->user->getClientSubTasks($client->task_id);
            $sub_tasks_array = [];
            foreach ($sub_tasks as $sub_task) {
                $sub_tasks_array[] = $sub_task->name;
            }
            $client->task_items = implode('<br>', $sub_tasks_array);

            $client->images = $this->task->getTaskCleanerImages($client->task_id);

            if ($client->task_repeat && strpos($client->repeat_mode, '_') !== false) {
                $repeat_modes = explode('_', $client->repeat_mode);
                $repeat_text = '';
                foreach ($repeat_modes as $repeat_mode) {
                    if ($repeat_mode != '') {
                        switch ($repeat_mode) {
                            case '0':
                                $repeat_text .= 'Sunday, ';
                                break;
                            case '1':
                                $repeat_text .= 'Monday, ';
                                break;
                            case '2':
                                $repeat_text .= 'Tuesday, ';
                                break;
                            case '3':
                                $repeat_text .= 'Wednesday, ';
                                break;
                            case '4':
                                $repeat_text .= 'Thursday, ';
                                break;
                            case '5':
                                $repeat_text .= 'Friday, ';
                                break;
                            case '6':
                                $repeat_text .= 'Saturday, ';
                                break;
                            default:
                                break;
                        }
                    }
                }
                $client->repeat_mode = $repeat_text;
            }

            foreach ($client->images as $image) {
                $image->path = config('STORAGE_URL') . $image->path;
            }
        }


        return response()->json(['clients' => $clients]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function feedback()
    {
        $cleaners = $this->user->getCleanersForReports();
        $clients = $this->user->getClientsForReports();
        $inspectors = $this->user->getInspectorsForReports();
        return view('page.reports.feedback', ['clients' => $clients, 'inspectors' => $inspectors, 'cleaners' => $cleaners]);
    }

    /**
     * @param ComplaintsExport $complaints_export
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function feedbackDownload(ComplaintsExport $complaints_export)
    {
        return Excel::download($complaints_export, 'feedback.xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feedbackFilter(Request $request)
    {
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request->to_date . ' 23:59:59')->format('Y-m-d H:i:s');
        $client = $request->client;
        $cleaner = $request->cleaner;
        $inspector = $request->inspector;

        $condition = '';

        if ($client != '') {
            $condition .= " AND clients.id = " . $client;
        }

        if ($cleaner != '') {
            $condition .= " AND cleaners.id = " . $cleaner;
        }

        if ($inspector != '') {
            $condition .= " AND inspectors.id = " . $inspector;
        }

        $feedbacks = $this->feedback->getFeedbackForReports($from_date, $to_date, $condition);

        foreach ($feedbacks as $feedback) {
            $feedback->media = $this->feedback->getFeedbackMedia($feedback->checklist_item_feedback_id);
            foreach ($feedback->media as $media) {
                $media->path = config('STORAGE_URL') . $media->path;
            }
            if ($feedback->checklist_audio) {
                $feedback->checklist_audio = config('STORAGE_URL') . $feedback->checklist_audio;
            }
        }

        return response()->json(['feedbacks' => $feedbacks]);
    }
}