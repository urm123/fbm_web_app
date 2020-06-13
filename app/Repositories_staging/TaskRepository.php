<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/14/2017
 * Time: 5:53 PM
 */

namespace App\Repositories;

use App\CleanerSchedule;
use App\Client;
use App\Schedule;
use App\Task;
use App\TaskItem;
use App\TaskOption;
use Illuminate\Support\Facades\DB;

/**
 * Class TaskRepository
 * @package App\Repositories
 */
class TaskRepository
{
    /**
     * @return mixed
     */
    public function getCurrentTasks()
    {
        return DB::table('tasks')
            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
//            ->join('client_task', 'tasks.id', '=', 'client_task.task_id')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
            ->where('schedules.repeat', '=', false)
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->orderBy('schedules.start_time', 'asc')
            ->get([
                'clients.id            AS client_id',
                'clients.name          AS client_first_name',
                'tasks.id              AS task_id',
                'tasks.name            AS task_name',
                'schedules.repeat      AS schedule_repeat',
                'schedules.repeat_mode AS schedule_repeat_mode',
                'schedules.start_time  AS schedule_start_time',
                'schedules.end_time    AS schedule_end_time',
                'tasks.notification'
            ]);
    }

    /**
     * @param string $name
     * @param int $client_id
     * @param string $address
     * @param string $latitude
     * @param string $longitude
     * @param string $type
     * @param string $status
     * @return mixed
     */
    public function createTask($name = '', $client_id = 0, $address = '', $latitude = '', $longitude = '', $type = '', $status = 'ACTIVE')
    {
        return Task::create([
            'name' => $name,
            'client_id' => $client_id,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'type' => $type,
            'status' => $status,
        ]);
    }

    /**
     * @param bool $repeat
     * @param string $start_time
     * @param string $end_time
     * @param string $repeat_mode
     * @return mixed
     */
    public function createSchedule($repeat = false, $start_time = '', $end_time = '', $repeat_mode = '')
    {
        return Schedule::create([
            'repeat' => $repeat,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'repeat_mode' => $repeat_mode,
        ]);
    }

    /**
     * @param int $task_id
     * @param string $name
     * @param int $checked
     * @return mixed
     */
    public function createTaskItem($task_id = 0, $name = '', $checked = 0)
    {
        return TaskItem::create([
            'task_id' => $task_id,
            'name' => $name,
            'checked' => $checked
        ]);
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getTasksByClient($client_id = 0)
    {
        return Task::where('client_id', '=', $client_id)
            ->whereNull('type')
            ->get([
                'id',
                'name',
            ]);
    }

    /**
     * @param int $task_id
     * @param int $cleaner_id
     * @param string $start_date
     * @param string $end_date
     * @return mixed
     */
    public function assignTaskToCleaner($task_id = 0, $cleaner_id = 0, $start_date = '', $end_date = '')
    {
        return DB::table('cleaner_task')->insert([
            'cleaner_id' => $cleaner_id,
            'task_id' => $task_id,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }

    /**
     * @param int $task_id
     * @param int $inspector_id
     * @param string $start_date
     * @param string $end_date
     * @return mixed
     */
    public function assignTaskToInspector($task_id = 0, $inspector_id = 0, $start_date = '', $end_date = '')
    {
        return DB::table('inspector_task')->insert([
            'task_id' => $task_id,
            'inspector_id' => $inspector_id,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }

    /**
     * @param int $task_id
     * @param string $date
     * @return mixed
     */
    public function getCleanerSchedule($task_id = 0, $date = '')
    {
        return DB::select(DB::raw("SELECT *
FROM cleaner_schedules
WHERE task_id = '" . $task_id . "' AND date(start_time) = '" . $date . "'"));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getClientLocation($client_id = 0)
    {
        return Client::where('id', '=', $client_id)
            ->first([
                'street_number',
                'street_name',
                'city',
                'post_code',
            ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTask($task_id = 0)
    {
        return Task::where('id', '=', $task_id)->first();
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTaskDetails($task_id = 0)
    {
        return DB::select(DB::raw("SELECT
  tasks.name                AS task_name,
  tasks.address             AS task_address,
  clients.name              AS client_name,
  clients.id              AS client_id,
  concat(clients.street_number, ', ', clients.street_name, ', ', clients.city, ' ',
         clients.post_code) AS client_address,
  cleaners.first_name       AS cleaner_first_name,
  cleaners.last_name        AS cleaner_last_name,
  cleaners.pan_number       AS cleaner_number,
  inspectors.first_name     AS inspector_first_name,
  inspectors.last_name      AS inspector_last_name,
  inspectors.pan_number     AS inspector_number,
  schedules.`repeat`        AS schedule_repeat,
  schedules.repeat_mode,
  schedules.start_time,
  schedules.end_time
FROM tasks
  INNER JOIN clients ON tasks.client_id = clients.id
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
WHERE tasks.id = $task_id"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTaskItems($task_id = 0)
    {
        return TaskItem::where('task_id', '=', $task_id)->get();
    }

    /**
     * @param int $task_id
     * @param bool $notification
     * @return mixed
     */
    public function updateNotification($task_id = 0, $notification = true)
    {
        return Task::where('id', '=', $task_id)->update([
            'notification' => $notification
        ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTaskCleanerImages($task_id = 0)
    {
        return DB::select(DB::raw("SELECT media.*
FROM media
  INNER JOIN cleaner_schedule_media ON media.id = cleaner_schedule_media.media_id
  INNER JOIN cleaner_schedules ON cleaner_schedule_media.cleaner_schedule_id = cleaner_schedules.id
WHERE cleaner_schedules.task_id = " . $task_id));
    }

    /**
     * separator for new function
     */

    /**
     * @param string $date
     * @param int $user_id
     * @return mixed
     */
    public function getTaskByDate($date = '', $user_id = 0)
    {
        return DB::select(DB::raw("SELECT MAX(schedules.start_time)      AS start_time,
       MAX(schedules.end_time)        AS end_time,
       MAX(clients.name)              AS client_first_name,
       MAX(tasks.id)                  AS task_id,
       count(distinct(task_items.id)) AS task_count,
       max(tasks.address)             AS task_address,
       max(tasks.latitude)            AS latitude,
       max(tasks.longitude)           AS longitude,
       max(schedules.repeat)          AS task_repeat,
       max(schedules.repeat_mode)     AS repeat_mode
FROM tasks
       INNER JOIN clients ON tasks.client_id = clients.id
       INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
       INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
       INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
       INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
       INNER JOIN task_items ON tasks.id = task_items.task_id
WHERE cleaners.user_id = '" . $user_id . "'
  AND tasks.status = 'active'
  AND schedules.`repeat` IS FALSE
  AND date(schedules.start_time) = '" . $date . "'
  AND clients.deleted_at IS NULL
GROUP BY tasks.id
ORDER BY max(schedules.start_time) DESC"));
    }

    /**
     * @param string $condition
     * @param int $user_id
     * @return mixed
     */
    public function getRepeatedTaskByDate($condition = '', $user_id = 0)
    {
        return DB::select(DB::raw("SELECT MAX(schedules.start_time)      AS start_time,
       MAX(schedules.end_time)        AS end_time,
       MAX(clients.name)              AS client_first_name,
       MAX(tasks.id)                  AS task_id,
       count(distinct(task_items.id)) AS task_count,
       max(tasks.address)             AS task_address,
       max(tasks.latitude)            AS latitude,
       max(tasks.longitude)           AS longitude,
       max(schedules.repeat)          AS task_repeat,
       max(schedules.repeat_mode)     AS repeat_mode
FROM tasks
       INNER JOIN clients ON tasks.client_id = clients.id
       INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
       INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
       INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
       INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
       INNER JOIN task_items ON tasks.id = task_items.task_id
WHERE cleaners.user_id = '" . $user_id . "'
  AND tasks.status = 'active'
  and clients.deleted_at is null
  AND schedules.`repeat` IS TRUE
  AND $condition
GROUP BY tasks.id
ORDER BY max(schedules.start_time) DESC"));
    }

    /**
     * @return mixed
     */
    public function getTasks()
    {
        return DB::select(DB::raw("SELECT
  tasks.id                                                                                             AS task_id,
  tasks.name                                                                                           AS task_name,
  clients.id                                                                                           AS client_id,
  clients.name                                                                                         AS client_name,
  concat(clients.street_number, ', ', clients.street_name, ', ', clients.city, ' ', clients.post_code) AS address,
  start_time,
  end_time,
  `repeat`,
  repeat_mode,
  cleaners.first_name                                                                                  AS cleaner_first_name,
  cleaners.last_name                                                                                   AS cleaner_last_name,
  inspectors.first_name                                                                                AS inspector_first_name,
  inspectors.last_name                                                                                 AS inspector_last_name
FROM tasks
  INNER JOIN clients ON tasks.client_id = clients.id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id WHERE cleaners.deleted_at IS NULL
  AND clients.deleted_at IS NULL AND inspectors.deleted_at IS NULL 
ORDER BY schedules.start_time DESC;"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTaskItemsForTasks($task_id = 0)
    {
        return TaskItem::where('task_id', '=', $task_id)->get([
            'name as task_item_name'
        ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTaskForAssign($task_id = 0)
    {
        return DB::select(DB::raw("SELECT
  *,
  tasks.id      AS task_id,
  tasks.name    AS task_name,
  cleaners.id   AS cleaner_id,
  inspectors.id AS inspector_id
FROM tasks
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE tasks.id = $task_id"));
    }

    /**
     * @param int $task_id
     * @param int $old_cleaner_id
     * @param int $new_cleaner_id
     * @return mixed
     */
    public function reassignCleanerToTask($task_id = 0, $old_cleaner_id = 0, $new_cleaner_id = 0)
    {
        return DB::table('cleaner_task')
            ->where('task_id', '=', $task_id)
            ->where('cleaner_id', '=', $old_cleaner_id)
            ->update([
                'cleaner_id' => $new_cleaner_id
            ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getCurrentCleanerFromTask($task_id = 0)
    {
        return DB::table('cleaner_task')
            ->where('task_id', '=', $task_id)
            ->first();
    }

    /**
     * @param int $task_id
     * @param int $old_inspector_id
     * @param int $new_inspector_id
     * @return mixed
     */
    public function reassignInspectorToTask($task_id = 0, $old_inspector_id = 0, $new_inspector_id = 0)
    {
        return DB::table('inspector_task')
            ->where('task_id', '=', $task_id)
            ->where('inspector_id', '=', $old_inspector_id)
            ->update([
                'inspector_id' => $new_inspector_id
            ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getCurrentInspectorFromTask($task_id = 0)
    {
        return DB::table('inspector_task')
            ->where('task_id', '=', $task_id)
            ->first();
    }

    /**
     * @param int $client_id
     * @return string
     */
    public function deleteClient($client_id = 0)
    {
//        try {
        return Client::where('id', '=', $client_id)->delete();
//        } catch (Exception $exception) {
//            return 'key';
//        }
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getClientDetails($client_id = 0)
    {
        return DB::select(DB::raw("SELECT
  cleaners.*,
  tasks.*,
  schedules.*
FROM cleaners
  INNER JOIN cleaner_task ON cleaners.id = cleaner_task.cleaner_id
  INNER JOIN tasks ON cleaner_task.task_id = tasks.id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
WHERE client_id =" . $client_id));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getClientInventory($client_id = 0)
    {
        return DB::select(DB::raw("SELECT *
FROM products
  INNER JOIN client_product ON products.id = client_product.product_id
WHERE client_id =" . $client_id));
    }

    /**
     * @param int $client_id
     * @param string $date
     * @return mixed
     */
    public function updateClientTermination($client_id = 0, $date = '')
    {
        return Client::where('id', '=', $client_id)->update([
            'termination_date' => $date
        ]);
    }

    /**
     * @param string $date
     * @return mixed
     */
    public function getFollowupOneTimeTasks($date = '')
    {
        return DB::select(DB::raw("SELECT
  max(clients.name)     AS client_name,
  max(tasks.name)       AS task_name,
  max(tasks.id)         AS task_id,
  max(tasks.updated_at) AS updated_at,
  max(tasks.updated_at) AS date,
  max(clients.id)       AS client_id
FROM tasks
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
  INNER JOIN clients ON tasks.client_id = clients.id
  LEFT JOIN client_followups ON tasks.id = client_followups.task_id
WHERE client_followups.id IS NULL
      AND `repeat` IS FALSE AND date(start_time) = '$date'
GROUP BY clients.id;"));
    }

    /**
     * @return mixed
     */
    public function getFollowupRepeatedTasks()
    {
        return DB::select(DB::raw("SELECT
  max(clients.name)     AS client_name,
  max(tasks.name)       AS task_name,
  max(tasks.id)         AS task_id,
  max(tasks.updated_at) AS updated_at,
  max(tasks.updated_at) AS date,
  max(clients.id)       AS client_id
FROM tasks
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
  INNER JOIN clients ON tasks.client_id = clients.id
  LEFT JOIN client_followups ON tasks.id = client_followups.task_id
WHERE client_followups.id IS NULL
      AND `repeat` IS TRUE
GROUP BY clients.id "));
    }

    /**
     * @param int $client_id
     * @param string $address
     * @param float $latitude
     * @param float $longitude
     * @return mixed
     */
    public function updateTaskLocation($client_id = 0, $address = '', $latitude = 0.0, $longitude = 0.0)
    {
        return Task::where('client_id', '=', $client_id)->update([
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    /**
     * @param int $cleaner_id
     * @return mixed
     */
    public function getCleanerTasks($cleaner_id = 0)
    {
        return DB::select(DB::raw("select max(clients.name) as client_name,
       max(tasks.name)   as task_name,
       max(`repeat`)     as `repeat`,
       max(repeat_mode)  as repeat_mode,
       max(start_time)   as start_time,
       max(end_time)     as end_time
from cleaner_task
       inner join tasks on cleaner_task.task_id = tasks.id
       inner join schedule_task on tasks.id = schedule_task.task_id
       inner join schedules on schedule_task.schedule_id = schedules.id
       inner join clients on tasks.client_id = clients.id
where cleaner_id = $cleaner_id
group by tasks.id;"));
    }

    /**
     * @return mixed
     */
    public function getAudio()
    {
        return DB::select(DB::raw("select audio,
       cleaner_schedules.id         as cleaner_schedule_id,
       cleaner_schedules.start_time as cleaner_start_time,
       tasks.name                   as task_name,
       tasks.id                     as task_id,
       clients.name                 as client_name,
       cleaners.first_name,
       cleaners.last_name,
       cleaner_schedule_audio.notification,
       cleaner_schedule_audio.id    as audio_id
from cleaner_schedule_audio
       inner join cleaner_schedules on cleaner_schedule_audio.cleaner_schedule_id = cleaner_schedules.id
       inner join tasks on cleaner_schedules.task_id = tasks.id
       inner join clients on tasks.client_id = clients.id
       inner join cleaners on cleaner_schedules.cleaner_id = cleaners.id
where cleaner_schedule_audio.notification is true;"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getIncompleteItems(int $task_id)
    {
        return DB::select(DB::raw("select *
from task_items
       left join task_item_status on task_items.id = task_item_status.task_item_id
where task_item_status.task_item_id is null and task_items.task_id = $task_id"));
    }

    /**
     * @param int $schedule_id
     * @param int $task_id
     * @param string $time
     * @return mixed
     */
    public function assignScheduleToTask(int $schedule_id, int $task_id, string $time)
    {
        return DB::table('schedule_task')->insert([
            'schedule_id' => $schedule_id,
            'task_id' => $task_id,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    /**
     * @param string $ticket
     * @return mixed
     */
    public function getTaskByName(string $ticket)
    {
        return Task::where('name', 'like', "%$ticket%")->first();
    }

    /**
     * @param int $cleaner_schedule_id
     * @return mixed
     */
    public function getTaskItemStatus(int $cleaner_schedule_id)
    {
        return DB::select(DB::raw("select *
from task_item_status
where cleaner_schedule_id = $cleaner_schedule_id;"));
    }

    /**
     * @param int $cleaner_schedule_id
     * @return mixed
     */
    public function getAudioByCleanerSchedule(int $cleaner_schedule_id)
    {
        return DB::select(DB::raw("select *
from cleaner_schedule_audio
where cleaner_schedule_id = $cleaner_schedule_id;"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getScheduleIdByTask(int $task_id)
    {
        return DB::select(DB::raw("select *
from schedule_task
where task_id = $task_id"));
    }

    /**
     * @param int $schedule_id
     * @param string $start_time
     * @param string $end_time
     * @return mixed
     */
    public function updateSchedule(int $schedule_id, string $start_time, string $end_time)
    {
        return Schedule::where('id', '=', $schedule_id)->update([
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);
    }

    /**
     * @param int $audio_id
     * @param bool $status
     * @return mixed
     */
    public function updateSound(int $audio_id, bool $status)
    {
        return DB::table('cleaner_schedule_audio')
            ->where('id', '=', $audio_id)
            ->update([
                'notification' => $status
            ]);
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function getOptions(string $type)
    {
        return TaskOption::where('type', 'like', $type)->get();
    }

    /**
     * @param string $text
     * @param string $type
     * @return mixed
     */
    public function createOption(string $text, string $type)
    {
        return TaskOption::create([
            'text' => $text,
            'type' => $type,
        ]);
    }

    /**
     * @param int $task_id
     * @param string $task_item
     * @return mixed
     */
    public function getTaskItemByName(int $task_id, string $task_item)
    {
        return TaskItem::where('task_id', '=', $task_id)
            ->where('name', 'like', $task_item)
            ->first();
    }

    /**
     * @param int $task_item_id
     * @return mixed
     */
    public function deleteTaskItem(int $task_item_id)
    {
        return TaskItem::where('id', '=', $task_item_id)
            ->delete();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function checkTaskName(string $name)
    {
        return TaskOption::where('id', '=', $name)
            ->first();
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function checkCompleted(int $task_id)
    {
        return DB::select(DB::raw("select *
from cleaner_schedules
       inner join task_status on cleaner_schedules.id = task_status.cleaner_schedule_id
where task_id = $task_id;"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getClient(int $task_id)
    {
        return DB::select(DB::raw("select clients.*
from clients
       inner join tasks on clients.id = tasks.client_id
where tasks.id = $task_id;"));
    }

    /**
     * @param int $schedule_id
     * @param bool $repeat
     * @param string $start_time
     * @param string $end_time
     * @param string $repeat_mode
     * @return mixed
     */
    public function updateRepeatedSchedule(int $schedule_id, bool $repeat, string $start_time, string $end_time, string $repeat_mode)
    {
        return Schedule::where('id', '=', $schedule_id)->update([
            'repeat' => $repeat,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'repeat_mode' => $repeat_mode,
        ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function deleteCleanersFromTask(int $task_id)
    {
        return DB::table('cleaner_task')->where('task_id', '=', $task_id)->delete();
    }

    /**
     * @param $task_id
     * @return mixed
     */
    public function deleteInspectorsFromTask($task_id)
    {
        return DB::table('inspector_task')->where('task_id', '=', $task_id)->delete();
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getCleanersByTask(int $task_id)
    {
        return DB::table('cleaner_task')->where('task_id', '=', $task_id)->get();
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getInspectorsByTask(int $task_id)
    {
        return DB::table('inspector_task')->where('task_id', '=', $task_id)->get();
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getCleanerScheduleForComplaint(int $task_id)
    {
        return DB::select(DB::raw("select *
from cleaner_schedules
       inner join task_item_status on cleaner_schedules.id = task_item_status.cleaner_schedule_id
where task_id = $task_id
  and status like 'FINISHED'"));
    }
}