<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/23/2017
 * Time: 11:44 AM
 */

namespace App\Http\Controllers;


use App\Repositories\RestCalendarRepository;
use App\Repositories\RestTaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class RestInspectorCalendarController
 * @package App\Http\Controllers
 */
class RestInspectorCalendarController extends Controller
{
    protected $calendar;
    protected $task;

    /**
     * RestInspectorCalendarController constructor.
     * @param RestCalendarRepository $rest_calendar_repository
     * @param RestTaskRepository $rest_task_repository
     */
    function __construct(RestCalendarRepository $rest_calendar_repository, RestTaskRepository $rest_task_repository)
    {
        $this->calendar = $rest_calendar_repository;
        $this->task = $rest_task_repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChecklist(Request $request)
    {
        $client_id = $request->client_id;
        $start_date = $request->date;
        $checklist = $this->calendar->getChecklist($client_id, $start_date);

        foreach ($checklist as $checklist_item) {
            $task_time = Carbon::parse($checklist_item->schedule_start_time);

            if ($task_time->isToday()) {
                $checklist_item->task_date = 'Today';
            } else if ($task_time->isTomorrow()) {
                $checklist_item->task_date = 'Tomorrow';
            } else {
                $checklist_item->task_date = $task_time->format('M j');
            }

            $checklist_item->task_time = $task_time->format('g:iA');
            $checklist_item->task_items = $this->task->getChecklistItems($checklist_item->task_id);

            foreach ($checklist_item->task_items as $task_item) {
                $task_item->checked = (boolean)$task_item->checked;
            }
        }

        return response()->json(['checklist' => $checklist]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInventory(Request $request)
    {
        $client_id = $request->client_id;
        $inventory = $this->calendar->getInventory($client_id);
        return response()->json(['inventory' => $inventory]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCalendar(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        if (!$month) {
            $month = Carbon::now()->month;
        }

        if (!$year) {
            $year = Carbon::now()->year;
        }


        $currentMonth = Carbon::parse($year . '-' . $month . '-01 00:00:00');

        $lastDayOfMonth = Carbon::parse($year . '-' . $month . '-01 00:00:00')->lastOfMonth();

        $monthDays = [];

        while ($currentMonth->lte($lastDayOfMonth)) {

            $todaysTasks = [];

            $oneTimeTasks = $this->task->getOneTimeTasks($currentMonth->toDateString());

            $repeatedTasks = $this->task->getRepeatedTasks();

            foreach ($oneTimeTasks as $oneTimeTask) {
                $todaysTasks[] = $oneTimeTask;
            }

            foreach ($repeatedTasks as $repeatedTask) {
                if ($repeatedTask->repeat_mode == 'daily') {
                    $todaysTasks[] = $repeatedTask;
                }

                if ($repeatedTask->repeat_mode == 'weekly' && Carbon::parse($repeatedTask->start_time)->dayOfWeek == $currentMonth->dayOfWeek) {
                    $todaysTasks[] = $repeatedTask;
                }

                if ($repeatedTask->repeat_mode == 'monthly' && Carbon::parse($repeatedTask->start_time)->day == $currentMonth->day) {
                    $todaysTasks[] = $repeatedTask;
                }

                if ($repeatedTask->repeat_mode == 'annually' && Carbon::parse($repeatedTask->start_time)->format('m-d') == $currentMonth->format('m-d')) {
                    $todaysTasks[] = $repeatedTask;
                }

                if ($repeatedTask->repeat_mode == 'semiannually' && Carbon::parse($repeatedTask->start_time)->format('m-d') == $currentMonth->format('m-d')) {
                    $todaysTasks[] = $repeatedTask;
                }

                if (strpos($repeatedTask->repeat_mode, '_') !== false) {
                    $repeatModes = explode('_', $repeatedTask->repeat_mode);
                    foreach ($repeatModes as $repeatMode) {
                        if ($repeatMode == $currentMonth->dayOfWeek && $repeatMode != '') {
                            $todaysTasks[] = $repeatedTask;
                        }
                    }
                }
            }

            $monthDays[] = [
                'date' => $currentMonth->day,
                'day' => $currentMonth->dayOfWeek,
                'tasks' => $todaysTasks
            ];
            $currentMonth->addDay();
        }

        return response()->json(['days' => $monthDays]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients()
    {
        $clients = $this->calendar->getClients();
        return response()->json(['clients' => $clients]);
    }
}