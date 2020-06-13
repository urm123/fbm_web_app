<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/3/2018
 * Time: 7:02 PM
 */

namespace App\Http\Controllers;


use App\Repositories\RestAlertRepository;
use App\Repositories\RestTaskRepository;
use App\Repositories\RestUserRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class RestInspectorAlertController
 * @package App\Http\Controllers
 */
class RestInspectorAlertController
{

    protected $alert;

    protected $user;

    protected $task;

    /**
     * RestInspectorAlertController constructor.
     * @param RestAlertRepository $rest_alert_repository
     * @param RestUserRepository $rest_user_repository
     * @param RestTaskRepository $rest_task_repository
     */
    function __construct(RestAlertRepository $rest_alert_repository, RestUserRepository $rest_user_repository, RestTaskRepository $rest_task_repository)
    {
        $this->alert = $rest_alert_repository;
        $this->user = $rest_user_repository;
        $this->task = $rest_task_repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAlerts()
    {
        $user_id = Auth::id();

        $inspector = $this->user->getInspector($user_id);

        $inspector_alerts = $this->alert->getInspectorAlerts($inspector->id);

        foreach ($inspector_alerts as $inspector_alert) {
            $message = str_replace(['Please check task ', ' for new complaint'], ['', ''], $inspector_alert->message);

            $inspector_alert->formatted = $message;

            $task = $this->task->getTaskByName($message);

            $task_items = $this->task->getTaskItems($task->id);

            $inspector_alert->task = $task->id;

            $client = $this->user->getClient($task->client_id);

            $inspector_alert->message = $inspector_alert->title;

            $inspector_alert->title = 'Complaint for client ' . $client->name . '. - ' . $task_items[0]->name;
        }
        return response()->json(['alerts' => $inspector_alerts]);
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