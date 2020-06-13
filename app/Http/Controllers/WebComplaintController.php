<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/6/2018
 * Time: 5:28 PM
 */

namespace App\Http\Controllers;


use App\Repositories\AlertRepository;
use App\Repositories\FeedbackRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Support\Push;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

/**
 * Class WebComplaintController
 * @package App\Http\Controllers
 */
class WebComplaintController extends Controller
{

    protected $feedback;

    protected $user;

    protected $task;

    protected $alert;

    protected $push;

    /**
     * WebComplaintController constructor.
     * @param FeedbackRepository $feedback_repository
     * @param UserRepository $user_repository
     * @param TaskRepository $task_repository
     * @param AlertRepository $alert_repository
     * @param Push $push
     */
    function __construct(FeedbackRepository $feedback_repository, UserRepository $user_repository, TaskRepository $task_repository, AlertRepository $alert_repository, Push $push)
    {
        $this->feedback = $feedback_repository;
        $this->user = $user_repository;
        $this->task = $task_repository;
        $this->alert = $alert_repository;
        $this->push = $push;
        $this->middleware('auth');
        $this->middleware('web_admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complaints()
    {
        $complaints = $this->feedback->getComplaints();
        $clients = $this->user->getClientsForComplaintsView();
        $cleaners = $this->user->getCleanersForComplaints();
        $inspectors = $this->user->getInspectorsForComplaints();

        foreach ($complaints as $complaint) {
            $images = $this->feedback->getComplaintImages($complaint->id);
            foreach ($images as $image) {
                $image->path = config('STORAGE_URL') . $image->path;
            }
            $complaint->images = $images;

            $audios = $this->feedback->getComplaintAudio($complaint->id);
            foreach ($audios as $audio) {
                $audio->path = config('STORAGE_URL') . $audio->path;
            }
            $complaint->audios = $audios;

            $videos = $this->feedback->getComplaintVideo($complaint->id);
            foreach ($videos as $video) {
                $video->path = config('STORAGE_URL') . $video->path;
            }
            $complaint->videos = $videos;

            $task = $this->task->getTaskByName($complaint->ticket);

            if ($task) {

                $cleaner_images = $this->task->getTaskCleanerImages($task->id);

                foreach ($cleaner_images as $cleaner_image) {
                    $cleaner_image->path = config('STORAGE_URL') . $cleaner_image->path;
                }

                $complaint->cleaner_images = $cleaner_images;
            } else {
                $complaint->cleaner_images = [];
            }

//            new code
//            new code

            $complaint->status = 'Pending';

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

//            new code
//            new code

        }
        return view('page.complaints.complaints', [
            'complaints' => $complaints,
            'cleaners' => $cleaners,
            'clients' => $clients,
            'inspectors' => $inspectors,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getComplaint(Request $request)
    {
        $complaintId = $request->complaint_id;
        $complaint = $this->feedback->getComplaint($complaintId);
        $task = $this->task->getTask($complaint->task_id);
        $client = $this->user->getClient($task->client_id);
        $inspector = $this->user->getInspector($complaint->inspector_id);
        $media = $this->feedback->getComplaintImages($complaint->id);
        $audios = $this->feedback->getComplaintAudio($complaint->id);
        foreach ($audios as $audio) {
            $audio->path = 'http://fbm.com/app/' . $audio->path;
        }

        foreach ($media as $image) {
            $image->path = config('STORAGE_URL') . $image->path;
            //$image->path =  'http://fbm.com/app/' . $image->path;
        }

        return view('page.complaints.view-complaint', [
            'complaint' => $complaint,
            'task' => $task,
            'inspector' => $inspector,
            'client' => $client,
            'audios' => $audios,
            'media' => $media
        ]);
    }

    public function editComplaint(Request $request)
    {
        $complaintId = $request->complaint_id;

        $complaint = $this->feedback->getComplaint($complaintId);

        $task = $this->task->getTask($complaint->task_id);

        $client = $this->user->getClient($task->client_id);

        $clients = $this->user->getClients();

        $media = $this->feedback->getComplaintImages($complaint->id);

        foreach ($media as $image) {
            $image->path = config('STORAGE_URL') . $image->path;
        }

        return view('page.complaints.edit', [
            'complaint' => $complaint,
            'clients' => $clients,
            'client' => $client,
            'media' => $media
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetComplaintFollowups(Request $request)
    {
        $complaint_id = $request->complaint_id;
        $complaint_followups = $this->feedback->getComplaintFollowups($complaint_id);

        foreach ($complaint_followups as $complaint_followup) {

            $complaint_followup->admin = $this->user->getAdministrator($complaint_followup->admin_id);

            $complaint_followup->inspector = $this->user->getInspector($complaint_followup->inspector_id);

            if ($complaint_followup->admin) {
                $complaint_followup->created_by = $complaint_followup->admin->first_name . ' ' . $complaint_followup->admin->last_name;
            }

            if ($complaint_followup->insepctor) {
                $complaint_followup->created_by = $complaint_followup->insepctor->first_name . ' ' . $complaint_followup->insepctor->last_name;
            }

            $complaint_followup->date = Carbon::parse($complaint_followup->date)->format('Y-m-d @ g:iA');
        }

        return response()->json(['complaint_followups' => $complaint_followups]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSaveComplaintFollowups(Request $request)
    {
        $complaint_id = $request->complaint_id;
        $user_id = Auth::id();
        $comment = $request->comment;
        $description = $request->description;
        $date = $request->date;

        $date = Carbon::parse($date)->format('Y-m-d H:i:s');

        $admin_id = $this->user->getAdminByUser($user_id)->id;

        if (isset($request->upload)) {
            $upload_file = $request->upload;
            $upload = $upload_file->store('complaints');
        } else {
            $upload = '';
        }

        $complaint_followup = $this->feedback->createComplaintFollowup($complaint_id, $admin_id, $comment, $description, $upload, $date);

        $this->feedback->updateComplaintTimeStamp($complaint_id);

        return response()->json(['complaint_followup' => $complaint_followup]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNew()
    {
        $clients = $this->user->getClientsForComplaints();
        return view('page.complaints.add-new', ['clients' => $clients]);
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
            'complaint' => 'string',
            'task' => 'required',
//            'start_date' => 'date|max:255|required',
//            'end_date' => 'date|max:255|required',
//            'start_time' => 'required',
//            'end_time' => 'required',
            'date' => 'date|max:255|required',
        ], $messages);

//        $cleaner = $request->cleaner;
//        $inspector = $request->inspector;
        $complaint = $request->complaint;
        $task = $request->task;
//        $start_date = $request->start_date;
//        $end_date = $request->end_date;
//        $start_time = $request->start_time;
//        $end_time = $request->end_time;
        $date = Carbon::now()->toDateTimeString();
        $task_details = $this->task->getTaskForAssign($task);
//        dd($task_details);

        $cleaner = $task_details[0]->cleaner_id;
        $inspector = $task_details[0]->inspector_id;
        $ticket = $task . '-' . $date;
        $complaint = $this->feedback->createComplaint($ticket, $cleaner, $task, $inspector, $date, $complaint);

        if (count($request->uploads)) {
            foreach ($request->uploads as $upload) {
                if ($upload) {
                    $upload_file = $upload;
                    $upload = $upload_file->store('complaints');
                    $extension = $upload_file->extension();

                    if($extension == 'mpga'){
                        $extension = 'audio';
                    }else{
                        $extension = 'image';
                    }

                    $media = $this->feedback->createComplaintMedia('complaint-' . $complaint->id, $upload);
                    $assign_media = $this->feedback->assignComplaintMedia($complaint->id, $media->id, $extension, Carbon::now()->toDateTimeString());
                }
            }
        }

        $task = $this->task->getTask($task);
        $client = $this->user->getClient($task->client_id);
        $client_address = $client->street_number . ', ' . $client->street_name . ', ' . $client->city . ' ' . $client->post_code;
        $address = str_replace(' ', '+', $client_address);
        $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
        $latitude_longitude = json_decode($geocode_to);

        if (!empty($latitude_longitude->results)) {
            $latitude = $latitude_longitude->results[0]->geometry->location->lat;
            $longitude = $latitude_longitude->results[0]->geometry->location->lng;
        } else {
            $latitude = '';
            $longitude = '';
        }

        $task_result = $this->task->createTask($task->id . '-' . $date . '-task', $task->client_id, $client_address, $latitude, $longitude, 'complaint', 'ACTIVE');
        $task_item_result = $this->task->createTaskItem($task_result->id, $complaint->complaint, 0);
//        $start_slot = Carbon::parse($start_date . ' ' . $start_time)->format('Y-m-d H:i:s');
//        $end_slot = Carbon::parse($end_date . ' ' . $end_time)->format('Y-m-d H:i:s');
//        $schedule = $this->task->createSchedule(false, $start_slot, $end_slot, null);
//        $task_schedule = $this->task->assignScheduleToTask($schedule->id, $task_result->id, Carbon::now()->toDateTimeString());
//        $schedule->tasks()->attach($task->id);
        $current_date = Carbon::now()->toDateString();
        $task_to_cleaner = $this->task->assignTaskToCleaner($task_result->id, $cleaner, $current_date, $current_date);

        $task_to_inspector = $this->task->assignTaskToInspector($task_result->id, $inspector, $current_date, $current_date);
        $this->push->push(['task' => $task, 'inspector' => $inspector]);
        $cleaner_alert = $this->alert->createAlert($complaint->complaint, 'Please check task ' . $task_result->name . ' for new complaint', 'cleaner', Carbon::now()->format('Y-m-d'));
        $inspector_alert = $this->alert->createAlert($complaint->complaint, 'Please check task ' . $task_result->name . ' for new complaint', 'inspector', Carbon::now()->format('Y-m-d'));

        $cleaner_alert_assign = $this->alert->assignAlertToCleaner($cleaner_alert->id, $cleaner, Carbon::now()->toDateTimeString());
        $inspector_alert_assign = $this->alert->assignAlertToInspector($inspector_alert->id, $inspector, Carbon::now()->toDateTimeString());

        if ($complaint && $task_result && $task_item_result && $task_to_cleaner && $task_to_inspector) {
            return redirect('/complaints')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'client' => 'required',
            'complaint' => 'string',
            'task' => 'required',
            'date' => 'date|max:255|required',
        ], $messages);

        $complaint_id = $request->complaint_id;
        $complaint = $request->complaint;
        $task = $request->task;
        $date = Carbon::now()->toDateTimeString();

        $current_complaint = $this->feedback->getComplaint($complaint_id);

        $exception = '0';

        if (count($request->images)) {
            foreach ($request->images as $image) {
                $exception .= ',' . $image;
            }
        }

        $this->feedback->deleteComplaintMediaExcept($complaint_id, $exception);
        if ($request->uploads) {
            if (count($request->uploads)) {
                foreach ($request->uploads as $upload) {
                    if ($upload) {
                        $upload_file = $upload;
                        $upload = $upload_file->store('complaints');
                        $media = $this->feedback->createComplaintMedia('complaint-' . $current_complaint->id, $upload);
                        $assign_media = $this->feedback->assignComplaintMedia($current_complaint->id, $media->id, Carbon::now()->toDateTimeString());
                    }
                }
            }
        }
        $update = $this->feedback->updateComplaint($complaint_id, $task, $date, $complaint);


        if ($update) {
            return redirect('/complaints')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxEndComplaintFollowups(Request $request)
    {
        $complaint_id = $request->complaint_id;
        $resolve_complaint = $this->feedback->endComplaintFollowup($complaint_id);

        $complaint = $this->feedback->getComplaint($complaint_id);

//        $task_id = explode('-', $complaint->ticket)[0];

//        $task = $this->task->getTask($task_id);

        $alert = 'Please check task ' . $complaint->ticket . '-task for new complaint';

        $this->alert->deleteAlertByName($alert);

        if ($resolve_complaint) {
            return response()->json(['message' => 'Success'], 200);
        }
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function ajaxAssignSchedule(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $complaint_id = $request->complaint_id;

        $complaint_tasks = $this->feedback->getTasksFromComplaints();

        foreach ($complaint_tasks as $complaint_task) {
            if ($complaint_id == explode('-', $complaint_task->name)[0]) {
                $task = $complaint_task;
            }
        }

//        $start_slot = Carbon::parse($start_date . ' ' . $start_time)->format('Y-m-d H:i:s');
//
//        $end_slot = Carbon::parse($end_date . ' ' . $end_time)->format('Y-m-d H:i:s');

//        $schedule = $this->task->createSchedule(false, $start_slot, $end_slot, null);

//        $task_schedule = $this->task->assignScheduleToTask($schedule->id, $task_result->id, Carbon::now()->toDateTimeString());

//        $schedule->tasks()->attach($task->id);

        return 'true';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postComplaintValidation(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $validator = Validator::make($request->all(), [
            'client' => 'required',
            'complaint' => 'string',
            'task' => 'required',
//            'start_date' => 'date|max:255|required',
//            'end_date' => 'date|max:255|required',
//            'start_time' => 'required',
//            'end_time' => 'required',
            'date' => 'date|max:255|required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Failed', 'validation' => $validator->messages()]);
        } else {
            return response()->json(['message' => 'Success']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDelete(Request $request)
    {
        $complaint_id = $request->complaint_id;
        $complaint = $this->feedback->getComplaint($complaint_id);

        $task = $this->task->getTaskByName($complaint->ticket . '-task');

        $alert = $this->alert->getAlertByName('Please check task ' . $complaint->ticket . '-task for new complaint');

        $this->feedback->deleteComplaintMedia($complaint_id);

        $this->feedback->deleteComplaintFollowups($complaint_id);

        $complaint_delete = $this->feedback->deleteComplaint($complaint_id);

        Schema::disableForeignKeyConstraints();
        $task_delete = $task->delete();
        $alert_delete = $alert->delete();
        Schema::enableForeignKeyConstraints();

//        if ($complaint_delete && $task_delete && $alert_delete) {
        return response()->json(['message' => 'Success']);
//        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComplaintFollowups(Request $request)
    {
        $complaintId = $request->complaint_id;
        $complaintFollowups = $this->feedback->getComplaintFollowups($complaintId);
        return response()->json(['followups' => $complaintFollowups]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveComplaintFollowup(Request $request)
    {

        $complaint_id = $request->complaint_id;
        $user_id = Auth::id();
        $comment = $request->comment;
        $description = $request->description;
        $date = $request->date;

        $date = Carbon::parse($date)->format('Y-m-d H:i:s');

        $admin_id = $this->user->getAdminByUser($user_id)->id;

        if (isset($request->upload)) {
            $upload_file = $request->upload;
            $upload = $upload_file->store('complaints');
        } else {
            $upload = '';
        }

        $complaint_followup = $this->feedback->createComplaintFollowup($complaint_id, $admin_id, $comment, $description, $upload, $date);

        $this->feedback->updateComplaintTimeStamp($complaint_id);

        return response()->json(['complaint_followup' => $complaint_followup]);
    }
}