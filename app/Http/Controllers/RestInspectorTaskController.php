<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/21/2017
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;


use App\Repositories\ChecklistRepository;
use App\Repositories\RestTaskRepository;
use App\Repositories\RestUserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RestCleanerTaskController
 * @package App\Http\Controllers
 */
class RestInspectorTaskController extends Controller
{
    protected $task;

    protected $user;

    protected $checklist;

    /**
     * RestInspectorTaskController constructor.
     * @param RestTaskRepository $rest_task_repository
     * @param RestUserRepository $rest_user_repository
     * @param ChecklistRepository $checklist_repository
     */
    function __construct(RestTaskRepository $rest_task_repository, RestUserRepository $rest_user_repository, ChecklistRepository $checklist_repository)
    {
        $this->task = $rest_task_repository;
        $this->user = $rest_user_repository;
        $this->checklist = $checklist_repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTasks(Request $request)
    {
        $cleaner_id = $request->cleaner_id;
        $tasks = $this->task->getCleanerTasks($cleaner_id);
        $now = Carbon::now();

        foreach ($tasks as $task) {
            if ($now->gt(Carbon::parse($task->start_time)) && $now->lt(Carbon::parse($task->end_time))) {
                $task->current = true;
            } else {
                if ($task->task_repeat) {
                    $start_time = Carbon::parse($task->start_time);
                    $end_time = Carbon::parse($task->end_time);
                    $repeat_mode = $task->repeat_mode;

                    $task_current_flag = Carbon::parse($start_time->toTimeString())->lt(Carbon::now()) && Carbon::parse($end_time->toTimeString())->gt(Carbon::now());

                    switch ($repeat_mode) {
                        case 'daily':
                            $repeat_main_flag = true;
                            break;
                        case 'weekly':
                            $repeat_main_flag = Carbon::now()->format('l') == $start_time->format('l');
                            break;
                        case 'monthly':
                            $repeat_main_flag = Carbon::now()->format('d') == $start_time->format('d');
                            break;
                        case 'annually':
                            $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            break;
                        case 'semiannually':
                            $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            break;
                        default:
                            if (strpos($task->repeat_mode, '_') !== false) {
                                $repeat_modes = explode('_', $task->repeat_mode);
                                $repeat_text = '';
                                $repeat_flag = false;

                                foreach ($repeat_modes as $repeat_mode_item) {
                                    if ($repeat_mode_item != '') {
                                        switch ($repeat_mode_item) {
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
                                        if ($repeat_mode_item == Carbon::now()->dayOfWeek) {
                                            $repeat_flag = true;
                                        }
                                    }
                                }
                                $repeat_main_flag = $repeat_flag;
                                $task->repeat_mode = $repeat_text;


                                if (Carbon::now()->dayOfWeek == $repeat_mode_item) {
                                    $task->task_date = 'Today';
                                    $task->start_date = 'Today';
                                    $task->end_date = 'Today';
                                } else {
                                    $task->task_date = 'Next Week   ';
                                    $task->start_date = 'Next Week';
                                    $task->end_date = 'Next Week';
                                }


//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            } else {
                                $repeat_main_flag = false;
                            }
                            break;
                    }

                    if ($repeat_main_flag) {
                        if ($task_current_flag) {
                            $task->current = true;
                        } else {
                            $task->current = false;
                        }
                    } else {
                        $task->current = false;
                    }

                } else {
                    $task->current = false;
                }
            }
        }

        $finished_tasks = $this->task->getFinishedTasks(Auth::id());

        return response()->json(['tasks' => $tasks, 'finished_tasks' => $finished_tasks]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function startTask(Request $request)
    {
        $task_id = $request->task_id;
        $user_id = Auth::id();
        $current_time = Carbon::now()->format('Y-m-d H:i:s');
        $task_start_response = $this->task->startInspectorTask($user_id, $task_id, $current_time);
        return response()->json(['started_task' => $task_start_response]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function endTask(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $current_time = Carbon::now()->format('Y-m-d H:i:s');
        $task_end_response = $this->task->endInspectorTask($schedule_id, $current_time);
        return response()->json(['task_end_response' => $task_end_response]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInventory(Request $request)
    {
        $task_id = $request->task_id;
        $inventory = $this->task->getInspectorInventory($task_id, Auth::id());
        foreach ($inventory as $inventory_item) {
            $inventory_item->qty = (int)$inventory_item->qty;
        }
        return response()->json(['inventory' => $inventory]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCleaners()
    {
        $today = Carbon::today();

        $yesterday = Carbon::yesterday();

        $cleaners_today = $this->user->getCleanersByDate(Auth::id(), $today->format('Y-m-d'));
        $cleaners_yesterday = $this->user->getCleanersByDate(Auth::id(), $yesterday->format('Y-m-d'));
        $cleaners = $this->user->getCleaners(Auth::id(), $yesterday->format('Y-m-d'));

        foreach ($cleaners as $cleaner) {
            $start_time = Carbon::parse($cleaner->start_time);

            if ($start_time->isToday()) {
                $cleaner->task_date = 'Today';
            } else if ($start_time->isTomorrow()) {
                $cleaner->task_date = 'Tomorrow';
            } else {
                $cleaner->task_date = $start_time->format('M j');
            }

            $cleaner->cleaner_id = (int)$cleaner->cleaner_id;
            $cleaner->client_count = (int)$cleaner->client_count;
        }

        foreach ($cleaners_today as $cleaner_today) {
            $start_time = Carbon::parse($cleaner_today->start_time);

            if ($start_time->isToday()) {
                $cleaner_today->task_date = 'Today';
            } else if ($start_time->isTomorrow()) {
                $cleaner_today->task_date = 'Tomorrow';
            } else {
                $cleaner_today->task_date = $start_time->format('M j');
            }
            $cleaner_today->cleaner_id = (int)$cleaner_today->cleaner_id;
            $cleaner_today->client_count = (int)$cleaner_today->client_count;
        }

        foreach ($cleaners_yesterday as $cleaner_yesterday) {
            $start_time = Carbon::parse($cleaner_yesterday->start_time);

            if ($start_time->isToday()) {
                $cleaner_yesterday->task_date = 'Today';
            } else if ($start_time->isTomorrow()) {
                $cleaner_yesterday->task_date = 'Tomorrow';
            } else {
                $cleaner_yesterday->task_date = $start_time->format('M j');
            }
            $cleaner_yesterday->cleaner_id = (int)$cleaner_yesterday->cleaner_id;
            $cleaner_yesterday->client_count = (int)$cleaner_yesterday->client_count;
        }

        return response()->json(['cleaners_last_month' => $cleaners, 'cleaners_today' => $cleaners_today, 'cleaners_yesterday' => $cleaners_yesterday]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCleanerTasks(Request $request)
    {
        $cleaner_id = $request->cleaner_id;
        $cleaner_user_id = $this->user->getUserIdByCleaner($cleaner_id);
        $tasks = $this->task->getCleanerTasks($cleaner_user_id->user_id);

        $now = Carbon::now();

        $cleaner_ended_tasks = [];

        foreach ($tasks as $task) {

            $task_time = Carbon::parse($task->start_time);

            $task->task_start = $task_time;

            if ($task_time->isToday()) {
                $task->task_date = 'Today';
            } else if ($task_time->isTomorrow()) {
                $task->task_date = 'Tomorrow';
            } else {
                $task->task_date = $task_time->format('M j');
            }

            $task->task_time = $task_time->format('g:iA');

            if ($now->gt(Carbon::parse($task->start_time)) && $now->lt(Carbon::parse($task->end_time))) {
                $task->current = true;
            } else {
                $start_time = Carbon::parse($task->start_time);
                $end_time = Carbon::parse($task->end_time);
                if ($task->task_repeat) {
                    $repeat_mode = $task->repeat_mode;

                    $task_current_flag = Carbon::parse($start_time->toTimeString())->lt(Carbon::now()) && Carbon::parse($end_time->toTimeString())->gt(Carbon::now());

                    switch ($repeat_mode) {
                        case 'daily':
                            $repeat_main_flag = true;
                            break;
                        case 'weekly':
                            $repeat_main_flag = Carbon::now()->format('l') == $start_time->format('l');
                            break;
                        case 'monthly':
                            $repeat_main_flag = Carbon::now()->format('d') == $start_time->format('d');
                            break;
                        case 'annually':
                            $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            break;
                        case 'semiannually':
                            $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            break;
                        default:
                            if (strpos($task->repeat_mode, '_') !== false) {
                                $repeat_modes = explode('_', $task->repeat_mode);
                                $repeat_text = '';
                                $repeat_flag = false;

                                foreach ($repeat_modes as $repeat_mode_item) {
                                    if ($repeat_mode_item != '') {
                                        switch ($repeat_mode_item) {
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
                                        if ($repeat_mode_item == Carbon::now()->dayOfWeek) {
                                            $repeat_flag = true;
                                        }
                                    }
                                }
                                $repeat_main_flag = $repeat_flag;
                                $task->repeat_mode = $repeat_text;


                                if (Carbon::now()->dayOfWeek == $repeat_mode_item) {
                                    $task->task_date = 'Today';
                                    $task->start_date = 'Today';
                                    $task->end_date = 'Today';
                                } else {
                                    $task->task_date = 'Next Week   ';
                                    $task->start_date = 'Next Week';
                                    $task->end_date = 'Next Week';
                                }


//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            } else {
                                $repeat_main_flag = false;
                            }
                            break;
                    }

                    if ($repeat_main_flag) {
                        if ($task_current_flag) {
                            $task->current = true;
                        } else {
                            $task->current = false;
                        }
                    } else {
                        $task->current = false;
                    }

                } else {
                    $task->current = false;
                }
            }

            $task_finished = $this->task->checkTaskFinished($task->task_id);

            $task_finished_status = $this->task->getLatestTaskFinishedStatus($task->task_id);

//            @todo Change this to remove testing purpose in the production version

            if ($task_finished > 0 && !$task->task_repeat) {
                $task_items = $this->task->getTaskItems($task->task_id);
                $task_item_status = true;
                foreach ($task_items as $task_item) {
                    if ($task_item->checked == '0') {
                        $task_item_status = false;
                    }
                    $task_item->checked = (boolean)$task_item->checked;
                }

                if ($task_item_status) {
                    $task->task_status = "FINISHED";
                } else {
                    $task->task_status = "INCOMPLETE";
                }
            } else {
                $task->task_status = "INCOMPLETE";
            }

            $task->task_id = (int)$task->task_id;
            $task->task_count = (int)$task->task_count;
        }

        $new_tasks = [];

        foreach ($tasks as $task) {
            if (!$task->task_repeat) {
                if ($task->task_status != 'FINISHED') {
                    $new_tasks[] = clone $task;
                } else {
                    $cleaner_ended_tasks[] = clone $task;
                }
            } else {
                if ($task_finished > 0) {
                    $task_items = $this->task->getTaskItems($task->task_id);
                    $task_item_status = true;
                    foreach ($task_items as $task_item) {
                        if ($task_item->checked == '0') {
                            $task_item_status = false;
                        }
                        $task_item->checked = (boolean)$task_item->checked;
                    }

                    if ($task_item_status) {
                        $task->task_status = "FINISHED";
                    } else {
                        $task->task_status = "INCOMPLETE";
                    }
                } else {
                    $task->task_status = "INCOMPLETE";
                }

                if ($task->task_status == 'FINISHED') {
                    $cleaner_ended_tasks[] = clone $task;
                }

                if ($task->repeat_mode == 'daily') {
                    if ($task->task_status != 'FINISHED') {
                        $task->task_date = 'Today';
                        $task->start_date = 'Today';
                        $task->end_date = 'Today';
                        $new_tasks[] = clone $task;
                    } else {
                        $task->task_date = 'Tomorrow';
                        $task->start_date = 'Tomorrow';
                        $task->end_date = 'Tomorrow';
                        $task->task_status = "INCOMPLETE";
                        $new_tasks[] = clone $task;
                    }
                } else if ($task->repeat_mode == 'weekly') {
                    if ($task->task_start->dayOfWeek == Carbon::now()->dayOfWeek) {
                        if ($task->task_status != 'FINISHED') {
                            $task->task_date = 'Today';
                            $task->start_date = 'Today';
                            $task->end_date = 'Today';
                            $new_tasks[] = clone $task;
                        } else {
                            $task->task_date = 'Next Week';
                            $task->start_date = 'Next Week';
                            $task->end_date = 'Next Week';
                            $task->task_status = "INCOMPLETE";
                            $new_tasks[] = clone $task;
                        }
                    }
                } else if ($task->repeat_mode == 'monthly' || $task->repeat_mode == 'annually' || $task->repeat_mode == 'semiannually') {
                    if ($task->task_start->format('d') == Carbon::now()->format('d')) {
                        if ($task->task_status != 'FINISHED') {
                            $task->task_date = 'Today';
                            $task->start_date = 'Today';
                            $task->end_date = 'Today';
                            $new_tasks[] = clone $task;
                        } else {
                            $task->task_date = 'Next Month';
                            $task->start_date = 'Next Month';
                            $task->end_date = 'Next Month';
                            $task->task_status = "INCOMPLETE";
                            $new_tasks[] = clone $task;
                        }
                    }
                }
            }
        }

        $finished_tasks = $this->task->getFinishedTasks($cleaner_user_id->user_id);


        foreach ($cleaner_ended_tasks as $cleaner_ended_task) {
            $finished_tasks[] = clone $cleaner_ended_task;
        }

        foreach ($finished_tasks as $finished_task) {
            $finished_task_time = Carbon::parse($finished_task->start_time);

            if ($finished_task_time->isToday()) {
                $finished_task->task_date = 'Today';
            } else if ($finished_task_time->isTomorrow()) {
                $finished_task->task_date = 'Tomorrow';
            } else {
                $finished_task->task_date = $finished_task_time->format('M j');
            }

            $finished_task->task_time = $finished_task_time->format('g:iA');
            $finished_task->task_id = (int)$finished_task->task_id;
            $finished_task->task_count = (int)$finished_task->task_count;
        }

        return response()->json(['tasks' => $tasks, 'finished_tasks' => $finished_tasks]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCleanerTask(Request $request)
    {
        $task_id = $request->task_id;
        $cleaner_id = $request->cleaner_id;
//        $task = $this->task->getCleanerTask($task_id);
        $task_items = $this->task->getCleanerTaskItems($task_id, $cleaner_id);

        $task_repeat_status = $this->task->getTaskRepeatStatus($task_id);

        $task_finished = $this->task->checkTaskFinishedToday($task_id);

        $task_status = "INCOMPLETE";

        if ($task_finished > 0) {
            $task_all_items = $this->task->getTaskItems($task_id);
            $task_item_status = true;
            foreach ($task_all_items as $task_all_item) {
                if ($task_all_item->checked == '0') {
                    $task_item_status = false;
                }
            }

            if ($task_item_status) {
                $task_status = "FINISHED";
            } else {
                $task_status = "INCOMPLETE";
            }
        } else {
            $task_status = "INCOMPLETE";
        }

        $audio = $this->task->getAudio($task_id, $cleaner_id);

        foreach ($audio as $item) {
            $item->audio = config('STORAGE_URL') . $item->audio;
        }

        foreach ($task_items as $task_item) {
            $task_item->images = $this->task->getTaskItemImages($task_item->task_item_id, $cleaner_id);
            foreach ($task_item->images as $image) {
                $image->image_path = config('STORAGE_URL') . $image->image_path;
            }
            $task_item->task_item_id = (int)$task_item->task_item_id;

            if ($this->task->getCleanerTaskItemStatus($task_item->task_item_id) > 0) {
                $task_item->finished = true;
            } else {
                $task_item->finished = false;
            }
//            $task_item->checked = (boolean)$task_item->checked;

            $task_repeat_status = $this->task->getTaskRepeatStatus($task_id);


            if ($request->recently_ended == "false" && $task_repeat_status->repeat) {
                if ($task_status == 'FINISHED') {
                    $task_item->checked = (boolean)false;
                } else {
                    $task_item->checked = (boolean)$task_item->checked;
                }
            } else {
                $task_item->checked = (boolean)$task_item->checked;
            }
        }
        return response()->json(['task' => $task_items, 'audio' => $audio]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTaskLocationValidation(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $task_id = $request->task_id;

        $task = $this->task->getTask($task_id);

//        if ($request->level == 'INSPECTOR_2') {
//            $user_id = Auth::id();
//            $current_time = Carbon::now()->format('Y-m-d H:i:s');
//            $task_start_response = $this->task->startInspectorTask($user_id, $task_id, $current_time);
//            $client = $this->user->getClient($task->client_id);
//            $checklists = $this->checklist->getChecklistsByCategory($client->category_id);
//
//            foreach ($checklists as $checklist) {
//                $checklist->items = $checklist->checklistItems()->get();
//                foreach ($checklist->items as $item) {
//                    $item->rating = 0;
//                }
//            }
//
//            return response()->json(['message' => 'Success', 'started_task' => $task_start_response, 'checklists' => $checklists], 200);
//        }

        $distance = $this->getDistance($latitude, $longitude, $task->latitude, $task->longitude);

        if ($distance > 1) {
            return response()->json(['message' => 'You are outside the location. Please go to location to start the task'], 400);
        } else {
            $user_id = Auth::id();
            $current_time = Carbon::now()->format('Y-m-d H:i:s');
            $task_start_response = $this->task->startInspectorTask($user_id, $task_id, $current_time);
            $client = $this->user->getClient($task->client_id);
            $checklists = $this->checklist->getChecklistsByCategory($client->category_id);

            foreach ($checklists as $checklist) {
                $checklist->items = $checklist->checklistItems()->get();
                foreach ($checklist->items as $item) {
                    $item->rating = 0;
                }
            }
            return response()->json(['message' => 'Success', 'started_task' => $task_start_response, 'checklists' => $checklists], 200);
        }
    }

    /**
     * @param float $latitude1
     * @param float $longitude1
     * @param float $latitude2
     * @param float $longitude2
     * @return float|int
     */
    public function getDistance($latitude1 = 0.00, $longitude1 = 0.00, $latitude2 = 0.00, $longitude2 = 0.00)
    {
        $earth_radius = 6371;

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * asin(sqrt($a));

        $d = $earth_radius * $c;

        return $d;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients()
    {
        $today = Carbon::now()->format('Y-m-d');
        $user_id = Auth::id();
        $schedules = $this->task->getRepeatSchedules($user_id);

        $repeated_clients = [];

        foreach ($schedules as $schedule) {
            $start_time = Carbon::parse($schedule->start_time);
            switch ($schedule->repeat_mode) {
                case 'daily':
                    $repeat_main_flag = true;
                    break;
                case 'weekly':
                    $repeat_main_flag = Carbon::now()->format('l') == $start_time->format('l');
                    break;
                case 'monthly':
                    $repeat_main_flag = Carbon::now()->format('d') == $start_time->format('d');
                    break;
                case 'annually':
                    $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                    break;
                case 'semiannually':
                    $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                    break;
                default:
                    $repeat_main_flag = false;
                    break;
            }

            if ($repeat_main_flag) {
                $repeated_clients[] = $schedule->id;
            }
        }

        if (!$repeated_clients) {
            $repeated_clients[] = 0;
        }

        $today_condition = "(date(schedules.start_time) = '" . $today . "' OR clients.id IN (" . implode(',', array_map('intval', $repeated_clients)) . "))";

        $today_clients = $this->task->getClientsByDate($today_condition, $user_id);
        foreach ($today_clients as $client) {
            $client->task_count = count($this->task->getTaskCount($client->client_id, $user_id));

            if ($client->street_number) {
                $client->address = $client->street_number . ', ' . $client->street_name;
            } else {
                $client->address = '';
            }

            $address = str_replace([' ', ','], '+', $client->address . ', ' . $client->post_code);
            $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
            $latitude_longitude = json_decode($geocode_to);

            if (!empty($latitude_longitude->results)) {
                $client->latitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lat, 6);
                $client->longitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lng, 6);
            } else {
                $client->latitude = null;
                $client->longitude = null;
            }

            $client->client_id = (int)$client->client_id;

        }

        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $yesterday_condition = "(date(schedules.start_time) = '" . $yesterday . "' OR clients.id IN (" . implode(',', array_map('intval', $repeated_clients)) . "))";
        $yesterday_clients = $this->task->getClientsByDate($yesterday_condition, $user_id);
        foreach ($yesterday_clients as $client) {
            $client->task_count = count($this->task->getTaskCount($client->client_id, $user_id));

            if ($client->street_number) {
                $client->address = $client->street_number . ', ' . $client->street_name;
            } else {
                $client->address = '';
            }
            $address = str_replace([' ', ','], '+', $client->address . ', ' . $client->post_code);
            $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
            $latitude_longitude = json_decode($geocode_to);

            if (!empty($latitude_longitude->results)) {
                $client->latitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lat, 6);
                $client->longitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lng, 6);
            } else {
                $client->latitude = null;
                $client->longitude = null;
            }

            $client->client_id = (int)$client->client_id;

        }

        $last_week = Carbon::now()->subWeek(1)->format('Y-m-d');
        $last_week_condition = "(date(schedules.start_time) > '" . $last_week . "' OR clients.id IN (" . implode(',', array_map('intval', $repeated_clients)) . "))";
        $last_week_clients = $this->task->getClientsByDate($last_week_condition, $user_id);
        foreach ($last_week_clients as $client) {
            $client->task_count = count($this->task->getTaskCount($client->client_id, $user_id));

            if ($client->street_number) {
                $client->address = $client->street_number . ', ' . $client->street_name;
            } else {
                $client->address = '';
            }

            $address = str_replace([' ', ','], '+', $client->address . ', ' . $client->post_code);

            $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
            $latitude_longitude = json_decode($geocode_to);

            if (!empty($latitude_longitude->results)) {
                $client->latitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lat, 6);
                $client->longitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lng, 6);
            } else {
                $client->latitude = null;
                $client->longitude = null;
            }

            $client->client_id = (int)$client->client_id;

        }

        $last_month = Carbon::now()->subMonth(1)->format('Y-m-d');
        $last_month_condition = "date(schedules.start_time) > '" . $last_month . "'";
        $last_month_clients = $this->task->getClientsByDate($last_month_condition, $user_id);
        foreach ($last_month_clients as $client) {
            $client->task_count = count($this->task->getTaskCount($client->client_id, $user_id));

            if ($client->street_number) {
                $client->address = $client->street_number . ', ' . $client->street_name;
            } else {
                $client->address = '';
            }

            $address = str_replace([' ', ','], '+', $client->address . ', ' . $client->post_code);
            $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
            $latitude_longitude = json_decode($geocode_to);

            if (!empty($latitude_longitude->results)) {
                $client->latitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lat, 6);
                $client->longitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lng, 6);
            } else {
                $client->latitude = null;
                $client->longitude = null;
            }

            $client->client_id = (int)$client->client_id;

        }


        if (Auth::user()->role == 'INSPECTOR_1') {

            $condition = "1=1";

            $clients = $this->task->getClientsByDate($condition, $user_id);
            foreach ($clients as $client) {

                $client->task_count = count($this->task->getTaskCount($client->client_id, $user_id));

                if ($client->street_number) {
                    $client->address = $client->street_number . ', ' . $client->street_name;
                } else {
                    $client->address = '';
                }

                $address = str_replace([' ', ','], '+', $client->address . ', ' . $client->post_code);
                $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
                $latitude_longitude = json_decode($geocode_to);

                if (!empty($latitude_longitude->results)) {
                    $client->latitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lat, 6);
                    $client->longitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lng, 6);
                } else {
                    $client->latitude = null;
                    $client->longitude = null;
                }

                $client->client_id = (int)$client->client_id;

                $last_clean_dates = $this->task->getCleanDates($client->client_id);

                if ($last_clean_dates) {
                    $client->last_clean_date = Carbon::parse($last_clean_dates[0]->start_time)->toFormattedDateString();
                } else {
                    $client->last_clean_date = '';
                }

                $last_inspection_dates = $this->task->getInspectionDates($client->client_id);

                if ($last_inspection_dates) {
                    $client->last_inspection_date = Carbon::parse($last_inspection_dates[0]->start_time)->toFormattedDateString();
                } else {
                    $client->last_inspection_date = '';
                }

            }

        } else {

            $condition = "1=1";

            $clients = $this->task->getAllClientsByDate($condition);
            foreach ($clients as $client) {

                $client->task_count = count($this->task->getAllTaskCount($client->client_id));

                if ($client->street_number) {
                    $client->address = $client->street_number . ', ' . $client->street_name;
                } else {
                    $client->address = '';
                }

                $address = str_replace([' ', ','], '+', $client->address . ', ' . $client->post_code);
                $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
                $latitude_longitude = json_decode($geocode_to);

                if (!empty($latitude_longitude->results)) {
                    $client->latitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lat, 6);
                    $client->longitude = (float)number_format($latitude_longitude->results[0]->geometry->location->lng, 6);
                } else {
                    $client->latitude = null;
                    $client->longitude = null;
                }

                $client->client_id = (int)$client->client_id;

                $last_clean_dates = $this->task->getCleanDates($client->client_id);

                if ($last_clean_dates) {
                    $client->last_clean_date = Carbon::parse($last_clean_dates[0]->start_time)->toFormattedDateString();
                } else {
                    $client->last_clean_date = '';
                }

                $last_inspection_dates = $this->task->getInspectionDates($client->client_id);

                if ($last_inspection_dates) {
                    $client->last_inspection_date = Carbon::parse($last_inspection_dates[0]->start_time)->toFormattedDateString();
                } else {
                    $client->last_inspection_date = '';
                }

            }

        }

//        $clients = [
//            'today_clients' => $today_clients,
//            'yesterday_clients' => $yesterday_clients,
//            'last_week_clients' => $last_week_clients,
//            'last_month_clients' => $last_month_clients,
//        ];

        return response()->json(['today_clients' => $clients]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClientTasks(Request $request)
    {
        $client_id = $request->client_id;

        if (Auth::user()->role == 'INSPECTOR_1') {

            $user_id = Auth::id();

            $non_started_tasks = $this->task->getNonStartedClientTasks($client_id, $user_id);

            foreach ($non_started_tasks as $task) {
                $start_time = Carbon::parse($task->start_time);

                if ($start_time->isToday()) {
                    $task->start_date = 'Today';
                } else if ($start_time->isTomorrow()) {
                    $task->start_date = 'Tomorrow';
                } else {
                    $task->start_date = $start_time->format('M j');
                }

                $task->start_time = $start_time->format('g:iA');

                $end_time = Carbon::parse($task->end_time);

                if ($end_time->isToday()) {
                    $task->end_date = 'Today';
                } else if ($end_time->isTomorrow()) {
                    $task->end_date = 'Tomorrow';
                } else {
                    $task->end_date = $end_time->format('M j');
                }

                $task->end_time = $end_time->format('g:iA');


                $task->task_id = (int)$task->task_id;

                $task->task_status = 'NOT_STARTED';

                $task->items = (int)count($this->task->getClientTaskItems($task->task_id));

                $task->latitude = (float)$task->latitude;
                $task->longitude = (float)$task->longitude;

                if (!$task->task_repeat) {
                    $task->repeat_mode = null;
                }

                if (strpos($task->repeat_mode, '_') !== false) {
                    $task->repeat_mode = 'Selected Dates';
//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                }

            }

            $incomplete_tasks = $this->task->getIncompleteClientTasks($client_id, $user_id);

            foreach ($incomplete_tasks as $task) {
                $start_time = Carbon::parse($task->start_time);

                if ($start_time->isToday()) {
                    $task->start_date = 'Today';
                } else if ($start_time->isTomorrow()) {
                    $task->start_date = 'Tomorrow';
                } else {
                    $task->start_date = $start_time->format('M j');
                }

                $task->start_time = $start_time->format('g:iA');

                $end_time = Carbon::parse($task->end_time);

                if ($end_time->isToday()) {
                    $task->end_date = 'Today';
                } else if ($end_time->isTomorrow()) {
                    $task->end_date = 'Tomorrow';
                } else {
                    $task->end_date = $end_time->format('M j');
                }

                $task->end_time = $end_time->format('g:iA');


                $task->task_id = (int)$task->task_id;

                $task->task_status = 'INCOMPLETE';

                $task_finished = $this->task->checkTaskFinished($task->task_id);

                if ($task_finished > 0) {
                    $task_items = $this->task->getTaskItems($task->task_id);
                    $task_item_status = true;
                    foreach ($task_items as $task_item) {
                        if ($task_item->checked == '0') {
                            $task_item_status = false;
                        }
                        $task_item->checked = (boolean)$task_item->checked;
                    }

                    if ($task_item_status) {
                        $task->task_status = "FINISHED";
                    } else {
                        $task->task_status = "INCOMPLETE";
                    }
                } else {
                    $task->task_status = "INCOMPLETE";
                }

                $task->items = (int)count($this->task->getClientTaskItems($task->task_id));

                $task->latitude = (float)$task->latitude;
                $task->longitude = (float)$task->longitude;

                if (!$task->task_repeat) {
                    $task->repeat_mode = null;
                }

                if (strpos($task->repeat_mode, '_') !== false) {
                    $task->repeat_mode = 'Selected Dates';
//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                }
            }

            foreach ($incomplete_tasks as $key => $incomplete_task) {
                if ($incomplete_task->task_status != 'INCOMPLETE') {
                    unset($incomplete_tasks[$key]);
                }
            }

            $new_incomplete_tasks = [];

            foreach ($incomplete_tasks as $incomplete_task) {
                $new_incomplete_tasks[] = $incomplete_task;
            }

            $finished_tasks = $this->task->getClientFinishedTasks($client_id, $user_id);

            foreach ($finished_tasks as $task) {
                $start_time = Carbon::parse($task->start_time);

                if ($start_time->isToday()) {
                    $task->start_date = 'Today';
                } else if ($start_time->isTomorrow()) {
                    $task->start_date = 'Tomorrow';
                } else {
                    $task->start_date = $start_time->format('M j');
                }

                $task->start_time = $start_time->format('g:iA');

                $end_time = Carbon::parse($task->end_time);

                if ($end_time->isToday()) {
                    $task->end_date = 'Today';
                } else if ($end_time->isTomorrow()) {
                    $task->end_date = 'Tomorrow';
                } else {
                    $task->end_date = $end_time->format('M j');
                }

                $task->end_time = $end_time->format('g:iA');


                $task->task_id = (int)$task->task_id;

                $task->task_status = 'INCOMPLETE';

                $task_finished = $this->task->checkTaskFinished($task->task_id);

                if ($task_finished > 0) {
                    $task_items = $this->task->getTaskItems($task->task_id);
                    $task_item_status = true;
                    foreach ($task_items as $task_item) {
                        if ($task_item->checked == '0') {
                            $task_item_status = false;
                        }
                        $task_item->checked = (boolean)$task_item->checked;
                    }

                    if ($task_item_status) {
                        $task->task_status = "FINISHED";
                    } else {
                        $task->task_status = "INCOMPLETE";
                    }
                } else {
                    $task->task_status = "INCOMPLETE";
                }

                $task->items = (int)count($this->task->getClientTaskItems($task->task_id));

                $task->latitude = (float)$task->latitude;
                $task->longitude = (float)$task->longitude;

                if (!$task->task_repeat) {
                    $task->repeat_mode = null;
                }

                if (strpos($task->repeat_mode, '_') !== false) {
                    $task->repeat_mode = 'Selected Dates';
//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                }
            }

            foreach ($finished_tasks as $key => $finished_task) {
                if ($finished_task->task_status != 'FINISHED') {
                    unset($finished_tasks[$key]);
                }
            }

            $new_finished_tasks = [];

            foreach ($finished_tasks as $finished_task) {
                $new_finished_tasks[] = $finished_task;
            }

        } else {
            $non_started_tasks = $this->task->getAllNonStartedClientTasks($client_id);

            foreach ($non_started_tasks as $task) {
                $start_time = Carbon::parse($task->start_time);

                if ($start_time->isToday()) {
                    $task->start_date = 'Today';
                } else if ($start_time->isTomorrow()) {
                    $task->start_date = 'Tomorrow';
                } else {
                    $task->start_date = $start_time->format('M j');
                }

                $task->start_time = $start_time->format('g:iA');

                $end_time = Carbon::parse($task->end_time);

                if ($end_time->isToday()) {
                    $task->end_date = 'Today';
                } else if ($end_time->isTomorrow()) {
                    $task->end_date = 'Tomorrow';
                } else {
                    $task->end_date = $end_time->format('M j');
                }

                $task->end_time = $end_time->format('g:iA');


                $task->task_id = (int)$task->task_id;

                $task->task_status = 'NOT_STARTED';

                $task->items = (int)count($this->task->getClientTaskItems($task->task_id));

                $task->latitude = (float)$task->latitude;
                $task->longitude = (float)$task->longitude;

                if (!$task->task_repeat) {
                    $task->repeat_mode = null;
                }

                if (strpos($task->repeat_mode, '_') !== false) {
                    $task->repeat_mode = 'Selected Dates';
//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                }

            }

            $incomplete_tasks = $this->task->getAllIncompleteClientTasks($client_id);

            foreach ($incomplete_tasks as $task) {
                $start_time = Carbon::parse($task->start_time);

                if ($start_time->isToday()) {
                    $task->start_date = 'Today';
                } else if ($start_time->isTomorrow()) {
                    $task->start_date = 'Tomorrow';
                } else {
                    $task->start_date = $start_time->format('M j');
                }

                $task->start_time = $start_time->format('g:iA');

                $end_time = Carbon::parse($task->end_time);

                if ($end_time->isToday()) {
                    $task->end_date = 'Today';
                } else if ($end_time->isTomorrow()) {
                    $task->end_date = 'Tomorrow';
                } else {
                    $task->end_date = $end_time->format('M j');
                }

                $task->end_time = $end_time->format('g:iA');


                $task->task_id = (int)$task->task_id;

                $task->task_status = 'INCOMPLETE';

                $task_finished = $this->task->checkTaskFinished($task->task_id);

                if ($task_finished > 0) {
                    $task_items = $this->task->getTaskItems($task->task_id);
                    $task_item_status = true;
                    foreach ($task_items as $task_item) {
                        if ($task_item->checked == '0') {
                            $task_item_status = false;
                        }
                        $task_item->checked = (boolean)$task_item->checked;
                    }

                    if ($task_item_status) {
                        $task->task_status = "FINISHED";
                    } else {
                        $task->task_status = "INCOMPLETE";
                    }
                } else {
                    $task->task_status = "INCOMPLETE";
                }

                $task->items = (int)count($this->task->getClientTaskItems($task->task_id));

                $task->latitude = (float)$task->latitude;
                $task->longitude = (float)$task->longitude;

                if (!$task->task_repeat) {
                    $task->repeat_mode = null;
                }

                if (strpos($task->repeat_mode, '_') !== false) {
                    $task->repeat_mode = 'Selected Dates';
//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                }
            }

            foreach ($incomplete_tasks as $key => $incomplete_task) {
                if ($incomplete_task->task_status != 'INCOMPLETE') {
                    unset($incomplete_tasks[$key]);
                }
            }

            $new_incomplete_tasks = [];

            foreach ($incomplete_tasks as $incomplete_task) {
                $new_incomplete_tasks[] = $incomplete_task;
            }

            $finished_tasks = $this->task->getAllClientFinishedTasks($client_id);

            foreach ($finished_tasks as $task) {
                $start_time = Carbon::parse($task->start_time);

                if ($start_time->isToday()) {
                    $task->start_date = 'Today';
                } else if ($start_time->isTomorrow()) {
                    $task->start_date = 'Tomorrow';
                } else {
                    $task->start_date = $start_time->format('M j');
                }

                $task->start_time = $start_time->format('g:iA');

                $end_time = Carbon::parse($task->end_time);

                if ($end_time->isToday()) {
                    $task->end_date = 'Today';
                } else if ($end_time->isTomorrow()) {
                    $task->end_date = 'Tomorrow';
                } else {
                    $task->end_date = $end_time->format('M j');
                }

                $task->end_time = $end_time->format('g:iA');


                $task->task_id = (int)$task->task_id;

                $task->task_status = 'INCOMPLETE';

                $task_finished = $this->task->checkTaskFinished($task->task_id);

                if ($task_finished > 0) {
                    $task_items = $this->task->getTaskItems($task->task_id);
                    $task_item_status = true;
                    foreach ($task_items as $task_item) {
                        if ($task_item->checked == '0') {
                            $task_item_status = false;
                        }
                        $task_item->checked = (boolean)$task_item->checked;
                    }

                    if ($task_item_status) {
                        $task->task_status = "FINISHED";
                    } else {
                        $task->task_status = "INCOMPLETE";
                    }
                } else {
                    $task->task_status = "INCOMPLETE";
                }

                $task->items = (int)count($this->task->getClientTaskItems($task->task_id));

                $task->latitude = (float)$task->latitude;
                $task->longitude = (float)$task->longitude;

                if (!$task->task_repeat) {
                    $task->repeat_mode = null;
                }

                if (strpos($task->repeat_mode, '_') !== false) {
                    $task->repeat_mode = 'Selected Dates';
//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                }
            }

            foreach ($finished_tasks as $key => $finished_task) {
                if ($finished_task->task_status != 'FINISHED') {
                    unset($finished_tasks[$key]);
                }
            }

            $new_finished_tasks = [];

            foreach ($finished_tasks as $finished_task) {
                $new_finished_tasks[] = $finished_task;
            }
        }

        return response()->json([
            'non_started_tasks' => $non_started_tasks,
            'incomplete_tasks' => $new_incomplete_tasks,
            'finished_tasks' => $new_finished_tasks
        ]);
    }
}