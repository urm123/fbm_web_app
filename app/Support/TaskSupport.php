<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/12/2018
 * Time: 11:41 AM
 */


namespace App\Support;

use App\Repositories\AlertRepository;
use App\Repositories\FeedbackRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class TaskSupport
 * @package App\Support
 */
class TaskSupport
{
    protected $task;
    protected $user;
    protected $alert;
    protected $complaint;

    /**
     * TaskSupport constructor.
     * @param TaskRepository $task_repository
     * @param UserRepository $user_repository
     * @param AlertRepository $alert_repository
     * @param FeedbackRepository $complaint_repository
     */
    function __construct(TaskRepository $task_repository, UserRepository $user_repository, AlertRepository $alert_repository, FeedbackRepository $complaint_repository)
    {
        $this->task = $task_repository;
        $this->user = $user_repository;
        $this->alert = $alert_repository;
        $this->complaint = $complaint_repository;
    }

    /**
     * @return bool|mixed
     */
    public function getTaskAlerts()
    {
        $tasks = $this->task->getCurrentTasks();

        foreach ($tasks as $task) {
            if ($task->schedule_repeat) {
                $task_date = Carbon::parse($task->schedule_start_time);


                if ($task->schedule_repeat_mode == 'daily') {

                    while ($task_date <= Carbon::today()) {
                        $cleaner_schedule = $this->task->getCleanerSchedule($task->task_id, $task_date->format('Y-m-d'));
                        $task_date->addDay();
                    }
                } else if ($task->schedule_repeat_mode == 'weekly') {
                    while ($task_date <= Carbon::today()) {
                        $cleaner_schedule = $this->task->getCleanerSchedule($task->task_id, $task_date->format('Y-m-d'));
                        $task_date->addWeek();
                    }
                } else if ($task->schedule_repeat_mode == 'monthly') {
                    while ($task_date <= Carbon::today()) {
                        $cleaner_schedule = $this->task->getCleanerSchedule($task->task_id, $task_date->format('Y-m-d'));
                        $task_date->addMonth();
                    }
                } else if (strpos($task->schedule_repeat_mode, '_') !== false) {
                    while ($task_date <= Carbon::today()) {
                        $cleaner_schedule = $this->task->getCleanerSchedule($task->task_id, $task_date->format('Y-m-d'));
                        $task_date->addDay();
                    }
                }
            } else {
                $cleaner_schedule = $this->task->getCleanerSchedule($task->task_id, Carbon::parse($task->schedule_start_time)->format('Y-m-d'));
            }

            if (empty($cleaner_schedule)) {
                $task->started = false;
            } else {
                $task->started = true;
            }

            $task->cleaner_schedule = $cleaner_schedule;
        }

        return $tasks;
    }

    /**
     * @return mixed
     */
    public function getMenus()
    {
        $user_id = Auth::id();

        $admin = $this->user->getAdminByUser($user_id);

        if ($admin) {

            $menus = $this->user->getMenus($admin->level, 1, 0);

            foreach ($menus as $menu) {
                $level_2_menus = $this->user->getMenus($admin->level, 2, $menu->id);
                foreach ($level_2_menus as $level_2_menu) {
                    $level_3_menus = $this->user->getMenus($admin->level, 3, $level_2_menu->id);
                    $level_2_menu->level_3 = $level_3_menus;
                }
                $menu->level_2 = $level_2_menus;
            }

            return $menus;
        } else {
            return false;
        }
//         $user_id = Auth::id();
//         $admin = $this->user->getAdminByUser($user_id);
//         $permission_array = array();

//         if ($admin) {
//             $adminPerm = $this->user->getAdminPermissionsByUser($user_id);
//             $menus = $this->user->getMenus(5, 1, 0);

//             foreach ($menus as $key => $menu) {
//                 foreach ($adminPerm as $key1 => $param) {
//                     if($param->name == $menu->name) {
//                         $item = array(
//                             'id' => $menu->id,
//                             'name' => $menu->name,
//                             'url' => $menu->url
//                         );
//                         $permission_array[] = $item;
//                     }
//                 }
// //                $level_2_menus = $this->user->getMenus($admin->level, 2, $menu->id);
// //                foreach ($level_2_menus as $level_2_menu) {
// //                    $level_3_menus = $this->user->getMenus($admin->level, 3, $level_2_menu->id);
// //                    $level_2_menu->level_3 = $level_3_menus;
// //                }
// //                $menu->level_2 = $level_2_menus;
//             }
//             $permObject = (object) $permission_array;
//             return $permObject;
//         } else {
//             return false;
//         }
    }

    /**
     * @return mixed
     */
    public function getAlerts()
    {
        $alerts = $this->alert->getAlerts();

        foreach ($alerts as $alert) {
            $alert->title = substr($alert->title, 0, 20) . ' ...';
            $message = str_replace(['Please check task ', ' for new complaint'], ['', ''], $alert->message);

            $task = $this->task->getTaskByName($message);

            if ($task) {
                $task_status = $this->task->checkCompleted($task->id);

                $completed = 'pending';

                foreach ($task_status as $status) {
                    if ($status->status == 'FINISHED') {
                        $completed = 'cleaner';
                    }
                }
            } else {
                $completed = 'pending';
            }

            $alert->task_status = $completed;
            $complaint_text = str_replace('-task', '', $message);
            $complaint = $this->complaint->getComplaintByTask($complaint_text);

            // if ($complaint->resolved) {
            //     $alert->task_status = 'resolved';
            // }
        }
        return $alerts;
    }

    /**
     * @return mixed
     */
    public function getCurrentAdmin()
    {
        $user_id = Auth::id();
        $admin = $this->user->getAdministratorByUser($user_id);
        return $admin;
    }
}