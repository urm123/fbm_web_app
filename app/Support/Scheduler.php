<?php
/**
 * Created by PhpStorm.
 * User: janaka
 * Date: 26/09/18
 * Time: 12:34 PM
 */

namespace App\Support;

use App\Mail\ScheduleMail;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

/**
 * Class Scheduler
 * @package App\Support
 */
class Scheduler
{
    protected $task;
    protected $user;

    /**
     * Scheduler constructor.
     * @param TaskRepository $task_repository
     * @param UserRepository $user_repository
     */
    public function __construct(TaskRepository $task_repository, UserRepository $user_repository)
    {
        $this->task = $task_repository;
        $this->user = $user_repository;
    }

    /**
     *
     */
    public function sendEmail()
    {
        $cleaners = $this->user->getCleaners();

        $email_data = [];

        foreach ($cleaners as $key => $cleaner) {
            $cleaner->email = $this->user->getUser($cleaner->user_id)->email;

            $cleaner_tasks = $this->task->getCleanerTasks($cleaner->id);

            foreach ($cleaner_tasks as $cleaner_task) {
                if ($cleaner_task->repeat) {
                    $start_time = Carbon::parse($cleaner_task->start_time);
                    switch ($cleaner_task->repeat_mode) {
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
                        case 'semiannually':
                            $repeat_main_flag = Carbon::now()->format('m-d') == $start_time->format('m-d');
                            break;
                        default:
                            if (strpos($cleaner_task->repeat_mode, '_') !== false) {
                                $repeat_modes = explode('_', $cleaner_task->repeat_mode);
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
                                        if ($repeat_mode_item == Carbon::now()->dayOfWeek) {
                                            $repeat_flag = true;
                                            $today_flag = true;
                                        }
                                    }
                                }

                                $repeat_main_flag = $repeat_flag;
                            } else {
                                $repeat_main_flag = false;
                            }
                            break;
                    }


                    if ($repeat_main_flag) {
//                        $email_data[$key]['cleaner'] = $cleaner;
//                        $email_data[$key]['tasks'][] = $cleaner_task;
                    }
                } else {
                    $email_data[$key]['cleaner'] = $cleaner;
                    if (Carbon::parse($cleaner_task->start_time)->toDateString() == Carbon::now()->toDateString()) {
                        $email_data[$key]['tasks'][] = $cleaner_task;
                    }
                }
            }
        }


        Mail::to('vanitha@focuscleaning.ca')->send(new ScheduleMail(['data' => $email_data]));
        Mail::to('mangapanchu@gmail.com')->send(new ScheduleMail(['data' => $email_data]));
        Mail::to('admin@focuscleaning.ca')->send(new ScheduleMail(['data' => $email_data]));

    }
}