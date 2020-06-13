<?php

namespace App\Http\Controllers\Inspector;

use App\ChecklistItemFeedback;
use App\Http\Controllers\Controller;
use App\Repositories\ChecklistRepository;
use App\Repositories\RestAlertRepository;
use App\Repositories\RestFeedbackRepository;
use App\Repositories\RestTaskRepository;
use App\Repositories\RestUserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class ChecklistController
 * @package App\Http\Controllers\Inspector
 */
class ChecklistController extends Controller
{

    protected $checklist_item_feedback;

    protected $feedback;

    protected $user;

    protected $task;

    protected $alert;

    protected $checklist;

    /**
     * ChecklistController constructor.
     * @param ChecklistRepository $checklist_repository
     * @param RestFeedbackRepository $feedback_repository
     * @param RestUserRepository $user_repository
     * @param RestTaskRepository $task_repository
     * @param RestAlertRepository $alert_repository
     * @param ChecklistRepository $checklist_item_repository
     */
    public function __construct(
        ChecklistRepository $checklist_repository,
        RestFeedbackRepository $feedback_repository,
        RestUserRepository $user_repository,
        RestTaskRepository $task_repository,
        RestAlertRepository $alert_repository,
        ChecklistRepository $checklist_item_repository
    )
    {
        $this->checklist_item_feedback = $checklist_repository;
        $this->feedback = $feedback_repository;
        $this->user = $user_repository;
        $this->task = $task_repository;
        $this->alert = $alert_repository;
        $this->checklist = $checklist_item_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach ($request->review as $review_item) {

            $request_item = json_decode($review_item, true);

            $checklist_item_feedback = $this->checklist_item_feedback->createChecklistItemFeedback($request_item);

            if ($request_item['feedback'] < 4) {
//                new code
//                new code
//                new code


                $task_id = $request_item['task_id'];
                $user_id = Auth::id();

                $checklist_item = $this->checklist->getChecklistItem($checklist_item_feedback->checklist_item_id);

                $complaint = $request->complaint;

                if (!$complaint) {
                    $complaint = $checklist_item->name;
                }

                $date = Carbon::now()->toDateTimeString();

//        dd($images);


                $inspector = $this->user->getInspector($user_id);

                $task = $this->task->getTask($task_id);

                $cleaner = $this->task->getCleanerTask($task_id);

                $client = $this->user->getClient($task->client_id);

                $client_address = $client->street_number . ', ' . $client->street_name . ', ' . $client->city . ' ' . $client->post_code;

                $address = str_replace(' ', '+', $client_address);

                $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');

                $latitude_longitude = json_decode($geocode_to);

                $ticket = $task_id . '-' . $date;
                $ticket_response = $this->feedback->saveTicket($cleaner[0]->cleaner_id, $task_id, $user_id, $ticket, $date, $complaint);

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

                $task_to_cleaner = $this->task->assignTaskToCleaner($task_result->id, $cleaner[0]->cleaner_id, $start_end_date, $start_end_date);

                $task_to_inspector = $this->task->assignTaskToInspector($task_result->id, $inspector->id, $start_end_date, $start_end_date);

                $cleaner_alert = $this->alert->createAlert($complaint, 'Please check task ' . $task_result->name . ' for new complaint', 'cleaner', Carbon::now()->format('Y-m-d'));

                $cleaner_alert_assign = $this->alert->assignAlertToCleaner($cleaner_alert->id, $cleaner[0]->cleaner_id, Carbon::now()->toDateTimeString());

//                new code
//                new code
//                new code
            }


            if (count($request->images)) {
                foreach ($request->images as $image) {

                    $file_name = $image->getClientOriginalName();
                    $parts = explode('_', $file_name);

                    if ($checklist_item_feedback->checklist_item_id == $parts[1]) {
                        $image_path = $image->store('image');

                        $media = $this->checklist_item_feedback->saveMedia($parts[1], $image_path);
                        $checklist_item_feedback->media()->attach($media->id);

                        if ($request_item['feedback'] < 4) {
                            $image_file = $image->store('complaints');

                            $create_image = $this->feedback->createImage('complaint-image-' . $task_id . '-' . $cleaner[0]->cleaner_id, $image_file);
                            $create_complaint_image = $this->feedback->createComplaintImage($create_image->id, $ticket_response->id, 'image');
                        }
                    }
                }
            }

            if (count($request->audio)) {
                foreach ($request->audio as $audio) {

                    $file_name = $audio->getClientOriginalName();

                    $parts = explode('_', $file_name);

                    if ($checklist_item_feedback->checklist_item_id == $parts[1]) {

                        $audio_path = $audio->store('audio');

                        $checklist_item_feedback->update(['audio' => $audio_path]);


                        if ($request_item['feedback'] < 4) {
                            $audio_file = $audio->store('complaints');

                            $create_audio = $this->feedback->createImage('complaint-audio-' . $task_id . '-' . $cleaner[0]->cleaner_id, $audio_file);
                            $create_complaint_image = $this->feedback->createComplaintImage($create_audio->id, $ticket_response->id, 'audio');
                        }

                    }
                }
            }

            if (count($request->video)) {
                foreach ($request->video as $video) {

                    $videoFilename = $video->getClientOriginalName();

                    $videoParts = explode('_', $videoFilename);

                    if ($checklist_item_feedback->checklist_item_id == $videoParts[1]) {

                        $videoPath = $video->store('video');

                        $checklist_item_feedback->update(['video' => $videoPath]);


                        if ($request_item['feedback'] < 4) {
                            $videoFile = $video->store('complaints');

                            $createVideo = $this->feedback->createImage('complaint-video-' . $task_id . '-' . $cleaner[0]->cleaner_id, $videoFile);
                            $create_complaint_image = $this->feedback->createComplaintImage($createVideo->id, $ticket_response->id, 'video');
                        }

                    }
                }
            }

        }

        if ($checklist_item_feedback) {
            return response()->json(['message' => 'Success'], 200);
        } else {
            return response()->json(['message' => 'Save Failed'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ChecklistItemFeedback $checklistItemFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(ChecklistItemFeedback $checklistItemFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ChecklistItemFeedback $checklistItemFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistItemFeedback $checklistItemFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ChecklistItemFeedback $checklistItemFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChecklistItemFeedback $checklistItemFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ChecklistItemFeedback $checklistItemFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistItemFeedback $checklistItemFeedback)
    {
        //
    }
}
