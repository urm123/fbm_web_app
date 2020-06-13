<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/13/2017
 * Time: 11:31 AM
 */

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TaskRepository;
use Carbon\Carbon;

/**
 * Class PageController
 * @package App\Http\Controllers
 */
class PageController extends Controller
{

    protected $task;

    /**
     * PageController constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        return $this->task = $taskRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function external()
    {
        return view('page.page.external');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function externalData()
    {

        $upcomingTasks = $this->task->getUpcomingTasks(Carbon::now()->toDateTimeString());

        foreach ($upcomingTasks as $upcomingTask) {
            $upcomingTask->time = Carbon::parse($upcomingTask->start_time)->format('Y jS M g:iA') . ' - ' . Carbon::parse($upcomingTask->end_time)->format('Y jS M g:iA');
            if ($upcomingTask->repeat) {
                $upcomingTask->time = Carbon::parse($upcomingTask->start_time)->format('g:iA') . ' - ' . Carbon::parse($upcomingTask->end_time)->format('g:iA');
            }
        }

        $incompleteTasks = $this->task->getIncompleteTasks();

        foreach ($incompleteTasks as $incompleteTask) {
            $incompleteTask->time = Carbon::parse($incompleteTask->start_time)->format('Y jS M g:iA') . ' - ' . Carbon::parse($incompleteTask->end_time)->format('Y jS M g:iA');
            if ($incompleteTask->repeat) {

                $incompleteTask->status = false;

                $incompleteTask->time = Carbon::parse($incompleteTask->start_time)->format('g:iA') . ' - ' . Carbon::parse($incompleteTask->end_time)->format('g:iA');

                $initialTime = Carbon::parse($incompleteTask->start_time);

                $startTime = Carbon::parse($incompleteTask->start_time);

                while ($initialTime->lte(Carbon::now())) {
                    switch ($incompleteTask->repeat_mode) {
                        case 'daily':
                            $incompleteTask->status = $this->getTaskCleanerScheduleStatus($incompleteTask->task_id, $initialTime->toDateString());
                            break;
                        case 'weekly':
                            if ($initialTime->dayOfWeek == $startTime->dayOfWeek) {
                                $incompleteTask->status = $this->getTaskCleanerScheduleStatus($incompleteTask->task_id, $initialTime->toDateString());
                            }
                            break;
                        case 'monthly':
                            if ($initialTime->format('m-d') == $startTime->format('m-d')) {
                                $incompleteTask->status = $this->getTaskCleanerScheduleStatus($incompleteTask->task_id, $initialTime->toDateString());
                            }
                            break;
                        default:
                            if (strpos($incompleteTask->repeat_mode, '_') !== false) {
                                $repeatModes = explode('_', $incompleteTask->repeat_mode);


                                foreach ($repeatModes as $repeatMode) {

                                    if ($repeatMode != '') {
                                        switch ($repeatMode) {
                                            case '0':
                                            case '1':
                                            case '2':
                                            case '3':
                                            case '4':
                                            case '5':
                                            case '6':
                                                $incompleteTask->status = $this->getTaskCleanerScheduleStatus($incompleteTask->task_id, $initialTime->toDateString());
                                                break;
                                            default:
                                                break;
                                        }
                                    }
                                }
                            }
                            break;
                    }
                    $initialTime->addDay();
                }

            } else {
                $status = $this->task->getTaskStatus($incompleteTask->task_id, $incompleteTask->cleaner_id);
                if (count($status)) {
                    $incompleteTask->status = false;
                } else {
                    $incompleteTask->status = true;
                }
            }
        }

        $filteredIncompleteTasks = [];

        foreach ($incompleteTasks as $incompleteTask) {
            if ($incompleteTask->status) {
                $filteredIncompleteTasks[] = $incompleteTask;
            }
        }

        $pendingComplaints = $this->task->getPendingComplaints();

        return response()->json([
            'message' => 'success',
            'upcomingTasks' => $upcomingTasks,
            'incompleteTasks' => $filteredIncompleteTasks,
            'pendingComplaints' => $pendingComplaints,
        ]);
    }

    /**
     * @param int $task_id
     * @param string $date
     * @return bool
     */
    public function getTaskCleanerScheduleStatus(int $task_id, string $date)
    {
        $status = false;

        $cleanerSchedules = $this->task->getCleanerSchedule($task_id, $date);
        if (count($cleanerSchedules)) {
            foreach ($cleanerSchedules as $cleanerSchedule) {
                $taskStatus = $this->task->getTaskStatusByCleanerSchedule($cleanerSchedule->id);
                if (count($taskStatus)) {
                    foreach ($taskStatus as $status) {
                        if ($status->status != 'FINISHED') {
                            $status = true;
                        }
                    }
                } else {
                    $status = true;
                }
            }
        } else {
            $status = true;
        }

        return $status;
    }
}