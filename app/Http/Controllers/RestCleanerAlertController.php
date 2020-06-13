<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/3/2018
 * Time: 6:54 PM
 */

namespace App\Http\Controllers;

use App\Repositories\RestAlertRepository;
use App\Repositories\RestTaskRepository;
use App\Repositories\RestUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class RestCleanerAlertController
 * @package App\Http\Controllers
 */
class RestCleanerAlertController extends Controller
{
    protected $alert;

    protected $task;

    protected $user;

    /**
     * RestCleanerAlertController constructor.
     * @param RestAlertRepository $rest_alert_repository
     * @param RestTaskRepository $rest_task_repository
     */
    function __construct(RestAlertRepository $rest_alert_repository, RestTaskRepository $rest_task_repository, RestUserRepository $rest_user_repository)
    {
        $this->alert = $rest_alert_repository;
        $this->task = $rest_task_repository;
        $this->user = $rest_user_repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAlerts()
    {
        $user_id = Auth::id();

        $cleaner = $this->user->getCleaner($user_id);

        $cleaner_alerts = $this->alert->getCleanerAlerts($cleaner->id);

        foreach ($cleaner_alerts as $cleaner_alert) {
            $message = str_replace(['Please check task ', ' for new complaint'], ['', ''], $cleaner_alert->message);

            $cleaner_alert->formatted = $message;

            $task = $this->task->getTaskByName($message);

            $task_items = $this->task->getTaskItems($task->id);

            $cleaner_alert->task = $task->id;

            $client = $this->user->getClient($task->client_id);

            $cleaner_alert->message = $cleaner_alert->title;

            $cleaner_alert->title = 'Complaint for client ' . $client->name . '. - ' . $task_items[0]->name;
        }
        return response()->json(['alerts' => $cleaner_alerts]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTask(Request $request)
    {
        $alert_id = $request->alert_id;

        $alert = $this->alert->getAlert($alert_id);

        $message = str_replace(['Please check task ', ' for new complaint'], ['', ''], $alert->message);

        $task = $this->task->getTaskByName($message);

        return response()->json(['task' => $task]);
    }
}