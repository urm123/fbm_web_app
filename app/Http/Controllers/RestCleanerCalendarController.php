<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/21/2017
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;


use App\Repositories\RestCalendarRepository;
use App\Repositories\RestTaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RestCleanerTaskController
 * @package App\Http\Controllers
 */
class RestCleanerCalendarController extends Controller
{
    protected $task;

    protected $calendar;

    /**
     * RestCleanerCalendarController constructor.
     * @param RestTaskRepository $rest_task_repository
     * @param RestCalendarRepository $rest_calendar_repository
     */
    function __construct(RestTaskRepository $rest_task_repository, RestCalendarRepository $rest_calendar_repository)
    {
        $this->task = $rest_task_repository;
        $this->calendar = $rest_calendar_repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCheckList(Request $request)
    {
        $client_id = $request->client_id;
        $date = $request->date;
        $checklist = $this->task->getChecklistForCleaner(Auth::id(), $client_id, $date);

        foreach ($checklist as $checklist_item) {
            $task_time = Carbon::parse($checklist_item->start_time);

            if ($task_time->isToday()) {
                $checklist_item->task_date = 'Today';
            } else if ($task_time->isTomorrow()) {
                $checklist_item->task_date = 'Tomorrow';
            } else {
                $checklist_item->task_date = $task_time->format('M j');
            }

            $checklist_item->task_time = $task_time->format('g:iA');

            $checklist_item->task_items = $this->task->getChecklistItems($checklist_item->id);

            foreach ($checklist_item->task_items as $task_item) {
                $task_item->checked = (boolean)$task_item->checked;
            }
        }

        return response()->json(['checklist' => $checklist,]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients()
    {
        $clients = $this->calendar->getCleanerClients(Auth::id());
        foreach ($clients as $client) {
            $client->id = (int)$client->id;
        }
        return response()->json(['clients' => $clients]);
    }
}