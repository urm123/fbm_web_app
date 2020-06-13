<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/21/2017
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;


use App\Mail\InvoiceMail;
use App\Mail\UserRegister;
use App\Repositories\AlertRepository;
use App\Repositories\RestFeedbackRepository;
use App\Repositories\RestTaskRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

/**
 * Class RestCleanerTaskController
 * @package App\Http\Controllers
 */
class RestCleanerTaskController extends Controller
{
    protected $task;

    protected $feedback;

    protected $user;

    protected $alert;

    /**
     * RestCleanerTaskController constructor.
     * @param RestTaskRepository $rest_task_repository
     * @param RestFeedbackRepository $feedback_repository
     * @param UserRepository $userRepository
     * @param AlertRepository $alertRepository
     */
    function __construct(RestTaskRepository $rest_task_repository, RestFeedbackRepository $feedback_repository, UserRepository $userRepository, AlertRepository $alertRepository)
    {
        $this->task = $rest_task_repository;
        $this->feedback = $feedback_repository;
        $this->user = $userRepository;
        $this->alert = $alertRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTasks()
    {
        $tasks = $this->task->getCleanerTasks(Auth::id());

        $now = Carbon::now();

        $cleaner_ended_tasks = [];
        $duplicate_repeat_mode = [];

        foreach ($tasks as $key => $task) {

            $duplicate_repeat_mode[] = $task->repeat_mode;

            if (!$task->task_repeat) {
                $task->repeat_mode = null;
            }

            $start_time = Carbon::parse($task->start_time);

            $task->task_start = $start_time;

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


            if ($now->gt(Carbon::parse($task->start_time)) && $now->lt(Carbon::parse($task->end_time))) {
                $task->current = true;
                if (strpos($task->repeat_mode, '_') !== false) {
                    $repeat_modes = explode('_', $task->repeat_mode);
                    $repeat_text = '';


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
                        }
                    }

                    $task->repeat_mode = 'Selected Days';

//                                $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                }
            } else {
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
                        case 'semiannually':
                            $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            break;
                        case 'annually':
                            $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            break;
                        default:
                            if (strpos($duplicate_repeat_mode[$key], '_') !== false) {
                                $repeat_modes = explode('_', $duplicate_repeat_mode[$key]);
                                $repeat_text = '';
                                $repeat_flag = false;

                                $today_flag = false;

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
                                        if ($repeat_mode_item != '' && $repeat_mode_item == Carbon::now()->dayOfWeek) {
                                            $repeat_flag = true;
                                            $today_flag = true;
                                        }
                                    }
                                }

                                $repeat_main_flag = $repeat_flag;
                                $task->repeat_mode = 'Selected Days';

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

            $task->task_id = (int)$task->task_id;
            $task->task_count = (int)$task->task_count;

            $task_finished = $this->task->checkTaskFinished($task->task_id);

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


            $task->latitude = (float)$task->latitude;

            $task->longitude = (float)$task->longitude;
        }

        $new_tasks = [];

        foreach ($tasks as $key => $task) {

            $today_flag = false;

            $expired = false;

            $task_finished = $this->task->checkTaskFinished($task->task_id);

            $task_finished_today = $this->task->checkTaskFinishedToday($task->task_id);

            if (!$task->task_repeat) {
                if ($task->task_status != 'FINISHED') {
                    $new_tasks[] = clone $task;
                } else {
                    $cleaner_ended_tasks[] = clone $task;
                }
            } else {
                $repeat_mode = $task->repeat_mode;

                $start_time = $task->start_time;

                $end_time = $task->end_time;

                $end_time_without_date = Carbon::parse($end_time)->format('H:i:s');

                $now = Carbon::now();

                switch ($repeat_mode) {
                    case 'daily':
                        if (Carbon::now()->gt(Carbon::parse($now->format('Y-m-d') . ' ' . Carbon::parse($end_time_without_date)->format('H:i:s')))) {
                            $cleaner_ended_tasks[] = clone $task;
                            $expired = true;
                        }
                        break;
                    case 'weekly':
                        if (Carbon::now()->dayOfWeek == Carbon::parse($start_time)->dayOfWeek && Carbon::now()->gt(Carbon::parse($now->format('Y-m-d') . ' ' . Carbon::parse($end_time_without_date)->format('H:i:s')))) {
                            $cleaner_ended_tasks[] = clone $task;
                            $expired = true;
                        }
                        break;
                    case'monthly':
                        if (Carbon::now()->format('d') == Carbon::parse($start_time)->format('d') && Carbon::now()->gt(Carbon::parse($now->format('Y-m-d') . ' ' . Carbon::parse($end_time_without_date)->format('H:i:s')))) {
                            $cleaner_ended_tasks[] = clone $task;
                            $expired = true;
                        }
                        break;
                    default:
                        if (strpos($duplicate_repeat_mode[$key], '_') !== false) {
                            $repeat_modes = explode('_', $duplicate_repeat_mode[$key]);
                            foreach ($repeat_modes as $repeat_mode_item) {
                                if ($repeat_mode_item != '' & Carbon::now()->dayOfWeek == $repeat_mode_item && Carbon::now()->gt(Carbon::parse($now->format('Y-m-d') . ' ' . Carbon::parse($end_time_without_date)->format('H:i:s')))) {
                                    $cleaner_ended_tasks[] = clone $task;
                                    $expired = true;
                                }
                                if ($repeat_mode_item != '' && $repeat_mode_item == Carbon::now()->dayOfWeek) {
                                    $today_flag = true;
                                }
                            }
                        }
                        break;
                }

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
                        if ($expired) {
                            $task->task_date = 'Tomorrow';
                            $task->start_date = 'Tomorrow';
                            $task->end_date = 'Tomorrow';
                        } else {
                            $task->task_date = 'Today';
                            $task->start_date = 'Today';
                            $task->end_date = 'Today';
                        }
                        $new_tasks[] = clone $task;
                    } else {
                        if ($task_finished_today > 0) {
                            $task->task_date = 'Tomorrow';
                            $task->start_date = 'Tomorrow';
                            $task->end_date = 'Tomorrow';
                            $task->task_status = "INCOMPLETE";
                            $new_tasks[] = clone $task;
                        } else {
                            $task->task_date = 'Today';
                            $task->start_date = 'Today';
                            $task->end_date = 'Today';
                            $task->task_status = "INCOMPLETE";
                            $new_tasks[] = clone $task;
                        }
                    }
                } else if ($task->repeat_mode == 'weekly') {
                    if ($task->task_start->dayOfWeek == Carbon::now()->dayOfWeek) {
                        if ($task->task_status != 'FINISHED') {
                            if ($expired) {
                                $task->task_date = 'Next Week';
                                $task->start_date = 'Next Week';
                                $task->end_date = 'Next Week';
                                $set = true;
                                for ($i = 1; $i < 8; $i++) {
                                    $next_day = Carbon::now()->addDays($i)->dayOfWeek;
                                    if ($next_day == $task->task_start->dayOfWeek) {
                                        if ($set) {
                                            $task->task_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                            $task->start_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                            $task->end_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                            $set = false;
                                        }
                                    }
                                }
                            } else {
                                $task->task_date = 'Today';
                                $task->start_date = 'Today';
                                $task->end_date = 'Today';
                            }
                            $new_tasks[] = clone $task;
                        } else {
                            if ($task_finished_today > 0) {
                                $task->task_date = 'Next Week';
                                $task->start_date = 'Next Week';
                                $task->end_date = 'Next Week';
                                $set = true;
                                for ($i = 1; $i < 8; $i++) {
                                    $next_day = Carbon::now()->addDays($i)->dayOfWeek;
                                    if ($next_day == $task->task_start->dayOfWeek) {
                                        if ($set) {
                                            $task->task_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                            $task->start_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                            $task->end_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                            $set = false;
                                        }
                                    }
                                }
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            } else {
                                $task->task_date = 'Today';
                                $task->start_date = 'Today';
                                $task->end_date = 'Today';
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            }
                        }
                    }
                } else if ($task->repeat_mode == 'monthly') {
                    if ($task->task_start->format('d') == Carbon::now()->format('d')) {
                        if ($task->task_status != 'FINISHED') {
                            if ($expired) {
                                $task->task_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                            } else {
                                $task->task_date = 'Today';
                                $task->start_date = 'Today';
                                $task->end_date = 'Today';
                            }
                            $new_tasks[] = clone $task;
                        } else {
                            if ($task_finished_today > 0) {
                                $task->task_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            } else {
                                $task->task_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addMonth()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            }
                        }
                    }
                } elseif ($task->repeat_mode == 'semiannually') {
                    if ($task->task_start->format('m-d') == Carbon::now()->format('m-d')) {
                        if ($task->task_status != 'FINISHED') {
                            $end_semi_annual = Carbon::parse($now->format('Y') . '-' . Carbon::parse($task->end_time)->format('m-d H:i:s'));
                            $expired = $now->gt($end_semi_annual);
                            if ($expired) {
                                $cleaner_ended_tasks[] = clone $task;
                                $task->task_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                            } else {
                                $task->task_date = 'Today';
                                $task->start_date = 'Today';
                                $task->end_date = 'Today';
                            }
                            $new_tasks[] = clone $task;
                        } else {
                            if ($task_finished_today > 0) {
                                $task->task_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            } else {
                                $task->task_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addMonths(6)->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            }
                        }
                    } elseif ($task->task_start->format('m-d') == Carbon::now()->addMonths(6)->format('m-d')) {
                        if ($task->task_status != 'FINISHED') {
                            $end_semi_annual = Carbon::parse($now->format('Y') . '-' . Carbon::parse($task->end_time)->addMonths(6)->format('m-d H:i:s'));
                            $expired = $now->gt($end_semi_annual);
                            if ($expired) {
                                $cleaner_ended_tasks[] = clone $task;
                                $task->task_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                            } else {
                                $task->task_date = 'Today';
                                $task->start_date = 'Today';
                                $task->end_date = 'Today';
                            }
                            $new_tasks[] = clone $task;
                        } else {
                            if ($task_finished_today > 0) {
                                $task->task_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            } else {
                                $task->task_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            }
                        }
                    }
                } elseif ($task->repeat_mode == 'annually') {
                    if ($task->task_start->format('m-d') == Carbon::now()->format('m-d')) {
                        if ($task->task_status != 'FINISHED') {
                            $end_annual = Carbon::parse($now->format('Y') . '-' . Carbon::parse($task->end_time)->format('m-d H:i:s'));
                            $expired = $now->gt($end_annual);
                            if ($expired) {
                                $cleaner_ended_tasks[] = clone $task;
                                $task->task_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                            } else {
                                $task->task_date = 'Today';
                                $task->start_date = 'Today';
                                $task->end_date = 'Today';
                            }
                            $new_tasks[] = clone $task;
                        } else {
                            if ($task_finished_today > 0) {
                                $task->task_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            } else {
                                $task->task_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->start_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->end_date = Carbon::now()->addYear()->format('Y-m') . '-' . Carbon::parse($task->start_time)->format('d');
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            }
                        }
                    }
                } else {
                    if (strpos($duplicate_repeat_mode[$key], '_') !== false) {
                        if ($task->task_status != 'FINISHED') {
                            if ($today_flag) {
                                if ($expired) {
                                    $task->task_date = 'Next Week';
                                    $task->start_date = 'Next Week';
                                    $task->end_date = 'Next Week';
                                    $set = true;
                                    $repeat_modes = explode('_', $duplicate_repeat_mode[$key]);
                                    for ($i = 1; $i < 8; $i++) {
                                        $next_day = Carbon::now()->addDays($i)->dayOfWeek;
                                        foreach ($repeat_modes as $repeat_mode_item) {
                                            if ($next_day == $repeat_mode_item && $repeat_mode_item != '') {
                                                if ($set) {
                                                    $task->task_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                    $task->start_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                    $task->end_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                    $set = false;
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    $task->task_date = 'Today';
                                    $task->start_date = 'Today';
                                    $task->end_date = 'Today';
                                }
                            } else {
                                $task->task_date = 'Next Week';
                                $task->start_date = 'Next Week';
                                $task->end_date = 'Next Week';
                                $set = true;
                                $repeat_modes = explode('_', $duplicate_repeat_mode[$key]);
                                for ($i = 1; $i < 8; $i++) {
                                    $next_day = Carbon::now()->addDays($i)->dayOfWeek;
                                    foreach ($repeat_modes as $repeat_mode_item) {
                                        if ($next_day == $repeat_mode_item && $repeat_mode_item != '') {
                                            if ($set) {
                                                $task->task_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                $task->start_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                $task->end_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                $set = false;
                                            }
                                        }
                                    }
                                }
                            }
                            $new_tasks[] = clone $task;
                        } else {
                            if ($task_finished_today > 0) {
                                $task->task_date = 'Next Week';
                                $task->start_date = 'Next Week';
                                $task->end_date = 'Next Week';
                                $set = true;
                                $repeat_modes = explode('_', $duplicate_repeat_mode[$key]);
                                for ($i = 1; $i < 8; $i++) {
                                    $next_day = Carbon::now()->addDays($i)->dayOfWeek;
                                    foreach ($repeat_modes as $repeat_mode_item) {
                                        if ($next_day == $repeat_mode_item && $repeat_mode_item != '') {
                                            if ($set) {
                                                $task->task_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                $task->start_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                $task->end_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                $set = false;
                                            }
                                        }
                                    }
                                }
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            } else {
                                if ($today_flag) {
                                    if ($expired) {
                                        $task->task_date = 'Next Week';
                                        $task->start_date = 'Next Week';
                                        $task->end_date = 'Next Week';
                                        $set = true;
                                        $repeat_modes = explode('_', $duplicate_repeat_mode[$key]);
                                        for ($i = 1; $i < 8; $i++) {
                                            $next_day = Carbon::now()->addDays($i)->dayOfWeek;
                                            foreach ($repeat_modes as $repeat_mode_item) {
                                                if ($next_day == $repeat_mode_item && $repeat_mode_item != '') {
                                                    if ($set) {
                                                        $task->task_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                        $task->start_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                        $task->end_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                        $set = false;
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        $task->task_date = 'Today';
                                        $task->start_date = 'Today';
                                        $task->end_date = 'Today';
                                    }
                                } else {
                                    $task->task_date = 'Next Week';
                                    $task->start_date = 'Next Week';
                                    $task->end_date = 'Next Week';
                                    $set = true;
                                    $repeat_modes = explode('_', $duplicate_repeat_mode[$key]);
                                    for ($i = 1; $i < 8; $i++) {
                                        $next_day = Carbon::now()->addDays($i)->dayOfWeek;
                                        foreach ($repeat_modes as $repeat_mode_item) {
                                            if ($next_day == $repeat_mode_item && $repeat_mode_item != '') {
                                                if ($set) {
                                                    $task->task_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                    $task->start_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                    $task->end_date = 'Next ' . Carbon::now()->addDays($i)->format('l');
                                                    $set = false;
                                                }
                                            }
                                        }
                                    }
                                }
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            }
                        }
                    } else {
                        if ($task->task_status != 'FINISHED') {
//                        $task->task_date = 'Today';
//                        $task->start_date = 'Today';
//                        $task->end_date = 'Today';
                            $new_tasks[] = clone $task;
                        } else {
                            if ($task_finished_today > 0) {
//                            $task->task_date = 'Tomorrow';
//                            $task->start_date = 'Tomorrow';
//                            $task->end_date = 'Tomorrow';
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            } else {
//                            $task->task_date = 'Today';
//                            $task->start_date = 'Today';
//                            $task->end_date = 'Today';
                                $task->task_status = "INCOMPLETE";
                                $new_tasks[] = clone $task;
                            }
                        }
                    }
                }
            }
        }

        $complaint_tasks = $this->task->getComplaintTasks(Auth::id());

        foreach ($complaint_tasks as $complaint_task) {
            $complaint_task->task_id = (int)$complaint_task->task_id;
            $complaint_task->task_count = (int)$complaint_task->task_count;

            $complaintNameArray = explode('-', str_replace('-task', '', $complaint_task->task_name));

            $complaintName = '';

            foreach ($complaintNameArray as $key => $item) {
                if ($key !== 0) {
                    $complaintName .= $item;
                }

                if ($key !== count($complaintNameArray) - 1) {
                    $complaintName .= '-';
                }
            }

            $complaint = $this->feedback->getComplaintByName($complaintName);

            $complaint_task->images = [];
            $complaint_task->audio = [];
            $complaint_task->video = [];

            if ($complaint) {
                $complaint_task->images = $this->feedback->getComplaintMedia($complaint->id, 'image');
                $complaint_task->audio = $this->feedback->getComplaintMedia($complaint->id, 'audio');
                $complaint_task->videos = $this->feedback->getComplaintMedia($complaint->id, 'video');
            }


//            $complaint_task->images = $this->feedback->getComplaintMedia();
            $new_tasks[] = clone $complaint_task;
        }

        $finished_tasks = $this->task->getFinishedTasks(Auth::id());

        foreach ($cleaner_ended_tasks as $cleaner_ended_task) {
//            $task_finished_status = $this->task->getLatestTaskFinishedStatus($cleaner_ended_task->task_id);
//            if (Carbon::parse($task_finished_status->start_time)->isToday()) {
//                $status_date = 'Today';
//            } else if (Carbon::parse($task_finished_status->start_time)->isTomorrow()) {
//                $status_date = 'Tomorrow';
//            } else {
//                $status_date = Carbon::parse($task_finished_status->start_time)->format('M j');
//            }
//            $cleaner_ended_task->task_date = $status_date;
//            $cleaner_ended_task->start_date = $status_date;
//            $cleaner_ended_task->end_date = $status_date;
            $finished_tasks[] = clone $cleaner_ended_task;
        }

        foreach ($finished_tasks as $finished_task) {
            $start_time = Carbon::parse($finished_task->start_time);

            if ($start_time->isToday()) {
                $finished_task->start_date = 'Today';
            } else if ($start_time->isTomorrow()) {
                $finished_task->start_date = 'Tomorrow';
            } else {
                $finished_task->start_date = $start_time->format('M j');
            }

            $finished_task->start_time = $start_time->format('g:iA');

            $end_time = Carbon::parse($finished_task->end_time);

            if ($end_time->isToday()) {
                $finished_task->end_date = 'Today';
            } else if ($end_time->isTomorrow()) {
                $finished_task->end_date = 'Tomorrow';
            } else {
                $finished_task->end_date = $end_time->format('M j');
            }

            $finished_task->end_time = $end_time->format('g:iA');

//            $finished_task->task_time = $start_time->format('g:iA');
            $finished_task->task_id = (int)$finished_task->task_id;
            $finished_task->task_count = (int)$finished_task->task_count;

            $task_finished = $this->task->checkTaskFinished($finished_task->task_id);


            if ($task_finished > 0) {
                $finished_task->task_status = "FINISHED";
            } else {
                $finished_task->task_status = "INCOMPLETE";
            }


            $finished_task->latitude = (float)$finished_task->latitude;

            $finished_task->longitude = (float)$finished_task->longitude;
        }

        return response()->json(['tasks' => $new_tasks, 'finished_tasks' => $finished_tasks]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @todo manage repeat tasks with start task
     */
    public function startTask(Request $request)
    {
        $task_id = $request->task_id;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $task = $this->task->getTask($task_id);

        //@todo: Need to add function for location validation (check $this->getDistance())

        $distance = $this->getDistance($latitude, $longitude, $task->latitude, $task->longitude);

        if ($distance > 1) {
            return response()->json(['message' => 'You are outside the location. Please go to location to start the task'], 400);
        }

        $schedule = $this->task->getTaskSchedule($task_id);

        if (!$schedule) {
            $user_id = Auth::id();
            $current_time = Carbon::now()->format('Y-m-d H:i:s');
            $task_start_response = $this->task->startCleanerTask($user_id, $task_id, $current_time, null);
            return response()->json(['started_task' => $task_start_response]);
        }

        $now = Carbon::now();

        $start_time = $schedule[0]->start_time;

        $task_finished = $this->task->checkTaskFinished($task_id);

        $task_status = 'INCOMPLETE';

        if ($task_finished > 0) {
            $task_items = $this->task->getTaskItems($task_id);
            $task_item_status = true;
            foreach ($task_items as $task_item) {
                if ($task_item->checked == '0') {
                    $task_item_status = false;
                }
                $task_item->checked = (boolean)$task_item->checked;
            }

            if ($task_item_status) {
                $task_status = "FINISHED";
            } else {
                $task_status = "INCOMPLETE";
            }
        } else {
            $task_status = "INCOMPLETE";
        }

        /**
         * Expired
         */

        $repeat_mode = $schedule[0]->repeat_mode;

        $start_time = $schedule[0]->start_time;

        $end_time = $schedule[0]->end_time;

        $end_time_without_date = Carbon::parse($end_time)->format('H:i:s');

        $now = Carbon::now();

        $expired = false;

        switch ($repeat_mode) {
            case 'daily':
                if (Carbon::now()->gt(Carbon::parse($now->format('Y-m-d') . ' ' . Carbon::parse($end_time_without_date)->format('H:i:s')))) {
                    $expired = true;
                }
                break;
            case 'weekly':
                if (Carbon::now()->dayOfWeek == Carbon::parse($start_time)->dayOfWeek && Carbon::now()->gt(Carbon::parse($now->format('Y-m-d') . ' ' . Carbon::parse($end_time_without_date)->format('H:i:s')))) {
                    $expired = true;
                }
                break;
            case'monthly':
                if (Carbon::now()->format('d') == Carbon::parse($start_time)->format('d') && Carbon::now()->gt(Carbon::parse($now->format('Y-m-d') . ' ' . Carbon::parse($end_time_without_date)->format('H:i:s')))) {
                    $expired = true;
                }
                break;
            default:
                if (strpos($schedule[0]->repeat_mode, '_') !== false) {
                    $repeat_modes = explode('_', $schedule[0]->repeat_mode);
                    foreach ($repeat_modes as $repeat_mode_item) {
                        if (Carbon::now()->dayOfWeek == $repeat_mode_item && Carbon::now()->gt(Carbon::parse($now->format('Y-m-d') . ' ' . Carbon::parse($end_time_without_date)->format('H:i:s')))) {
                            $expired = true;
                        }
                    }
                }
                break;
        }

        /**
         * Expired
         */

        if ($schedule[0]->repeat) {
            switch ($schedule[0]->repeat_mode) {
                case 'weekly':
                    if ($now->dayOfWeek != Carbon::parse($start_time)->dayOfWeek || $expired/**|| $task_status == "FINISHED"**/) {
                        return response()->json(['message' => 'You cannot start the task before given time.'], 400);
                    }
                    break;
                case 'monthly':
                    if ($now->format('d') != Carbon::parse($start_time)->format('d') || $expired/**|| $task_status == "FINISHED"**/) {
                        return response()->json(['message' => 'You cannot start the task before given time.'], 400);
                    }
                    break;
                case 'annually':
                    if ($now->format('m-d') != Carbon::parse($start_time)->format('m-d') || $expired/**|| $task_status == "FINISHED"**/) {
                        return response()->json(['message' => 'You cannot start the task before given time.'], 400);
                    }
                    break;
                default:
                    if (strpos($schedule[0]->repeat_mode, '_') !== false) {
                        $repeat_modes = explode('_', $schedule[0]->repeat_mode);

                        $today = false;

                        foreach ($repeat_modes as $repeat_mode) {
                            if ($repeat_mode == $now->dayOfWeek) {
                                $today = true;
                            }
                        }

                        if (!$today || $expired/**|| $task_status == "FINISHED"**/) {
                            return response()->json(['message' => 'You cannot start the task before given time.'], 400);
                        }

//                        $cleaner_schedule = $this->task->getCleanerScheduleByTask($task_id, Carbon::now()->toDateString());

                        $task_items = $this->task->getTaskItems($task_id);

                        $task_item_flag = false;

                        $task_item_check_flag = false;

                        foreach ($task_items as $task_item) {
                            $task_item_check = $this->task->getCleanerSchedule($task_item->id, Carbon::now()->toDateString());

                            if (count($task_item_check) <= 0) {
                                $task_item_flag = true;
                            }

                            if (!$task_item->checked) {
                                $task_item_check_flag = true;
                            }
                        }

                        if (!$task_item_flag && !$task_item_check_flag) {
                            return response()->json(['message' => 'You cannot start the task before given time.'], 400);
                        }

                    }
                    break;
            }
        } else {
            if (Carbon::parse($schedule[0]->start_time)->gt($now)) {
                return response()->json(['message' => 'You cannot start the task before given time.'], 400);
            }
        }

        $user_id = Auth::id();
        $current_time = Carbon::now()->format('Y-m-d H:i:s');
        $schedule_task = $this->task->getScheduleByTask($task_id);
        $task_start_response = $this->task->startCleanerTask($user_id, $task_id, $current_time, $schedule_task->id);
        return response()->json(['started_task' => $task_start_response]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @todo Complete this function with proper inventory update with cleaner_product and client_product tables
     * @todo Manage repeat tasks with end task
     */
    public function endTask(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $products = $request->inventories;
        $current_time = Carbon::now()->format('Y-m-d H:i:s');
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $task_id = $this->task->getTaskByCleanerSchedule($schedule_id);

        $task = $this->task->getTask($task_id->task_id);

        $distance = $this->getDistance($latitude, $longitude, $task->latitude, $task->longitude);

        if ($distance > 1) {
            return response()->json(['message' => 'You are outside the location. Please go to location to end the task'], 400);
        }

//        $task = $this->task->getTaskByCleanerSchedule($schedule_id);

        foreach ($products as $product) {
            $product_id = $product['id'];
            $product_quantity = $product['qty'];
            $original_quantity = $this->task->getProductQuantity($product_id);
            $original_client_quantity = $this->task->getClientProductQuantity($product_id, $task->client_id);

            $reduced_quantity = $original_client_quantity->quantity - $product_quantity;

            $remaining_quantity = $original_quantity->qty - $reduced_quantity;

//            $current_quantity = $original_quantity->qty - $product_quantity;
            $current_quantity = $product_quantity;
//            $this->task->updateInventory($product_id, $remaining_quantity);
            $this->task->updateClientInventory($product_id, $task->client_id, $current_quantity);
//            $task_product = $this->task->getTaskProduct($product_id, $task->id);
//            $current_task_quantity = $task_product->qty - $product_quantity;
//            $update_task_product_quantity = $this->task->updateTaskProducts($task_product->id, $current_task_quantity);
            $add_new_cleaner_schedule_product = $this->task->addNewCleanerScheduleProduct($product_id, $schedule_id, $product_quantity);
        }

        $cleanerSchedule = $this->task->getCleanerScheduleById($schedule_id);

        $cleaner = $this->user->getCleanerFromSchedule($schedule_id);

        $taskStatus = $this->task->getTaskStatus($schedule_id);

        $task_end_response = $this->task->endCleanerTask($schedule_id, $current_time, $taskStatus->schedule_task_id);

        $cleanerDuration = Carbon::parse($cleanerSchedule->end_time)->diffInSeconds(Carbon::parse($cleanerSchedule->start_time));

        $schedule = $this->task->getTaskSchedule($cleanerSchedule->task_id);

        $scheduleStartTime = Carbon::parse(Carbon::now()->format('Y-m-d') . ' ' . Carbon::parse($schedule[0]->start_time)->toTimeString());
        $scheduleEndTime = Carbon::parse(Carbon::now()->format('Y-m-d') . ' ' . Carbon::parse($schedule[0]->end_time)->toTimeString());

        $scheduleDuration = $scheduleEndTime->diffInSeconds($scheduleStartTime);

        $client = $this->user->getClient($task->client_id);

        if ($cleanerDuration < $scheduleDuration) {
            $inspector_alert = $this->alert->createAlert('Productive alert', 'Please check task ' . $task->name . ' of ' . $client->name . ' as cleaner ' . $cleaner[0]->cleaner . ' did less hours than scheduled', 'inspector', Carbon::now()->format('Y-m-d'));
        }

        if ($task_end_response) {


            Mail::to('janaka@codelantic.com')->send(new InvoiceMail([
                'cleaner' => $cleaner[0]->cleaner,
                'task' => $task->name,
                'client' => $client->name,
            ]));
        }

        return response()->json(['task_end_response' => $task_end_response]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInventory(Request $request)
    {
        $task_id = $request->task_id;
        $user_id = Auth::id();
        $inventory = $this->task->getCleanerInventory($user_id, $task_id);

        foreach ($inventory as $inventory_item) {
            $inventory_item->qty = (int)$inventory_item->qty;
            $inventory_item->product_quantity = (int)$inventory_item->product_quantity;
        }

        return response()->json(['inventory' => $inventory]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTaskList(Request $request)
    {
        $task_id = $request->task_id;

        $task_list = $this->task->getTaskList($task_id);
        $task_repeat_status = $this->task->getTaskRepeatStatus($task_id);
        $task_finished = $this->task->checkTaskFinished($task_id);

        $task = $this->task->getTask($task_id);

        if ($task->type == 'complaint') {
            $explode = explode('-task', $task->name);

            $complaint = $this->feedback->getComplaintByName($explode[0]);

            $complaint_images = $this->feedback->getComplaintMedia($complaint->id, 'image');

            foreach ($complaint_images as $complaint_image) {
                $complaint_image->path = config('STORAGE_URL') . $complaint_image->path;
            }

            $complaint_audio = $this->feedback->getComplaintMedia($complaint->id, 'audio');

            foreach ($complaint_audio as $audio) {
                $audio->path = config('STORAGE_URL') . $audio->path;
            }
        } else {
            $complaint_images = [];
            $complaint_audio = [];
        }


//            @todo Change this to remove testing purpose in the production version

        $task_status = "INCOMPLETE";

        if ($task_finished > 0) {
            $task_items = $this->task->getTaskItems($task_id);
            $task_item_status = true;

            foreach ($task_items as $task_item) {
                if ($task_item->checked == '0') {
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

        foreach ($task_list as $task_list_item) {
            if ($task_repeat_status) {
                if ($request->recently_ended == "false" && $task_repeat_status->repeat) {
                    if ($task_status == 'FINISHED') {
                        $task_list_item->checked = (boolean)false;
                    } else {
                        $task_list_item->checked = (boolean)$task_list_item->checked;
                    }
                } else {
                    $task_list_item->checked = (boolean)$task_list_item->checked;
                }
            }
            $task_list_item->images = $complaint_images;
            $task_list_item->audio = $complaint_audio;
        }
        return response()->json(['task_list' => $task_list]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postTaskImages(Request $request)
    {

        $task_item_id = $request->task_item_id;
        $cleaner_schedule_id = $request->cleaner_schedule_id;
        $images = $request->images;

        foreach ($images as $image) {
            $image_file = $image->store('tasks');

            $create_image = $this->task->createImage('task-image-' . $cleaner_schedule_id . '-' . $task_item_id, $image_file);
            $create_cleaner_schedule_image = $this->task->createCleanerScheduleImage($create_image->id, $cleaner_schedule_id, $task_item_id);
        }

        return response()->json(['message' => 'Images saved successfully']);
    }

    /**
     * @param $latitude1
     * @param $longitude1
     * @param $latitude2
     * @param $longitude2
     * @return float|int
     */
    public function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function completeTasks(Request $request)
    {
        $task_items = $request->tasks;

        $cleaner_schedule_id = $request->schedule_id;

        $audio = $request->audio;

        $audio = $request->audio;

        foreach ($task_items as $task_item) {
            $task_schedule = $this->task->getTaskScheduleByTaskItem($task_item['task_id']);
            if ($task_schedule) {
                $this->task->updateTaskItemCompletion($task_item['task_id'], $task_item['isCompleted'], $task_schedule->schedule_task_id, $cleaner_schedule_id);
            } else {
                $this->task->updateTaskItemCompletion($task_item['task_id'], $task_item['isCompleted'], null, $cleaner_schedule_id);
            }
        }

        if ($audio) {

            $file_name = 'audio/audio_' . Carbon::now()->format('YmdHis') . '.m4a';

            $audio = str_replace('data:audio/x-m4a;base64,', '', $audio);
            $audio = str_replace(' ', '+', $audio);

            Storage::disk('local')->put($file_name, base64_decode($audio));

            $this->task->createAudio($cleaner_schedule_id, $file_name, Carbon::now()->toDateTimeString());
        }
        return response()->json(['message' => 'Added to completed tasks']);
    }
}