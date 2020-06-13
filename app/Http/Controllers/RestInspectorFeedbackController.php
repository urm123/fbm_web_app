<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/23/2017
 * Time: 2:05 PM
 */

namespace App\Http\Controllers;


use App\Repositories\RestAlertRepository;
use App\Repositories\RestFeedbackRepository;
use App\Repositories\RestTaskRepository;
use App\Repositories\RestUserRepository;
use App\Repositories\TaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RestInspectorFeedbackController
 * @package App\Http\Controllers
 */
class RestInspectorFeedbackController extends Controller
{
    protected $feedback;

    protected $task;

    protected $user;

    protected $alert;

    /**
     * RestInspectorFeedbackController constructor.
     * @param RestFeedbackRepository $rest_feedback_repository
     * @param RestTaskRepository $rest_task_repository
     * @param RestUserRepository $rest_user_repository
     */
    function __construct(RestFeedbackRepository $rest_feedback_repository, RestTaskRepository $rest_task_repository, RestUserRepository $rest_user_repository, RestAlertRepository $rest_alert_repository)
    {
        $this->feedback = $rest_feedback_repository;
        $this->task = $rest_task_repository;
        $this->user = $rest_user_repository;
        $this->alert = $rest_alert_repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFeedbackData()
    {
        $feedback_data = $this->feedback->getFeedbackData();
        return response()->json(['feedback_data' => $feedback_data]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postFeedback(Request $request)
    {
        $cleaner_id = $request->cleaner_id;
        $task_id = $request->task_id;
        $user_id = Auth::id();
        $feedback = $request->feedback;
        $rating = $request->rating;

        $date = Carbon::now()->format('Y-m-d H:i:s');

        $feedback_response = $this->feedback->saveFeedback($cleaner_id, $task_id, $user_id, $feedback, $rating, $date);

        $schedule_id = $request->schedule_id;
        $current_time = Carbon::now()->format('Y-m-d H:i:s');
        $task_end_response = $this->task->endInspectorTask($schedule_id, $current_time);

        return response()->json(['message' => 'Feedback added successfully.', 'task_end_response' => $task_end_response]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTicketData()
    {
        $ticket_data = $this->feedback->getTicketData();
        $ticket = str_random(5);
        return response()->json(['ticket_data' => $ticket_data, 'ticket' => $ticket]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postTicket(Request $request)
    {
        $cleaner_id = $request->cleaner_id;
        $task_id = $request->task_id;
        $user_id = Auth::id();
        $complaint = $request->complaint;
        $date = Carbon::now()->toDateTimeString();
        $images = $request->images;

        $schedule_id = $request->schedule_id;
        $current_time = Carbon::now()->format('Y-m-d H:i:s');
        $task_end_response = $this->task->endInspectorTask($schedule_id, $current_time);

//        dd($images);

        $ticket = $task_id . '-' . $date;
        $ticket_response = $this->feedback->saveTicket($cleaner_id, $task_id, $user_id, $ticket, $date, $complaint);


        foreach ($images as $image) {
            $image_file = $image->store('complaints');

            $create_image = $this->feedback->createImage('complaint-image-' . $task_id . '-' . $cleaner_id, $image_file);
            $create_complaint_image = $this->feedback->createComplaintImage($create_image->id, $ticket_response->id, 'image');
        }

        $inspector = $this->user->getInspector($user_id);

        $task = $this->task->getTask($task_id);

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

        $task_result = $this->task->createTask($task_id . '-' . $date . '-task', $task->client_id, $client_address, $latitude, $longitude, 'complaint', 'ACTIVE');

        $start_end_date = Carbon::now()->format('Y-m-d H:i:s');

        $task_item_result = $this->task->createTaskItem($task_result->id, $complaint, 0);

        $task_to_cleaner = $this->task->assignTaskToCleaner($task_result->id, $cleaner_id, $start_end_date, $start_end_date);

        $task_to_inspector = $this->task->assignTaskToInspector($task_result->id, $inspector->id, $start_end_date, $start_end_date);

        $cleaner_alert = $this->alert->createAlert($complaint, 'Please check task ' . $task_result->name . ' for new complaint', 'cleaner', Carbon::now()->format('Y-m-d'));

        $cleaner_alert_assign = $this->alert->assignAlertToCleaner($cleaner_alert->id, $cleaner_id, Carbon::now()->toDateTimeString());

        return response()->json(['ticket_response' => $ticket_response, 'task_end_response' => $task_end_response]);
    }
}