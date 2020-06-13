<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/21/2017
 * Time: 3:57 PM
 */

namespace App\Repositories;

use App\Cleaner;
use App\CleanerSchedule;
use App\CleanerScheduleMedia;
use App\CleanerScheduleProduct;
use App\Inspector;
use App\InspectorSchedule;
use App\Media;
use App\Product;
use App\Task;
use App\TaskItem;
use App\TaskItemStatus;
use App\TaskProduct;
use App\TaskStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class RestTaskRepository
 * @package App\Repositories
 */
class RestTaskRepository
{
    /**
     * @param int $user_id
     * @return mixed
     */
    public function getCleanerTasks($user_id = 0)
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
       max(schedules.repeat_mode)     AS repeat_mode,
       max(tasks.type)                as task_type
FROM tasks
       INNER JOIN clients ON tasks.client_id = clients.id
       INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
       INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
       INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
       INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
       INNER JOIN task_items ON tasks.id = task_items.task_id
WHERE cleaners.user_id = $user_id
  AND tasks.status = 'active'
  AND (schedules.`repeat` IS TRUE OR schedules.end_time > now())
  AND cleaners.deleted_at IS NULL
GROUP BY tasks.id
ORDER BY max(schedules.start_time) DESC"));
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getComplaintTasks($user_id = 0)
    {
        return DB::select(DB::raw("SELECT MAX(clients.name)              AS client_first_name,
       MAX(tasks.id)                  AS task_id,
       count(distinct(task_items.id)) AS task_count,
       max(tasks.address)             AS task_address,
       max(tasks.latitude)            AS latitude,
       max(tasks.longitude)           AS longitude,
       max(tasks.type)                as task_type,
       max(tasks.name)                as task_name
FROM tasks
       INNER JOIN clients ON tasks.client_id = clients.id
       INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
       INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
       INNER JOIN task_items ON tasks.id = task_items.task_id
WHERE cleaners.user_id = $user_id
  AND tasks.status = 'active'
  AND tasks.type like 'complaint'
    AND cleaners.deleted_at IS NULL GROUP BY tasks.id"));
    }

    /**
     * @param int $user_id
     * @param int $task_id
     * @param string $start_time
     * @param int $schedule_task_id
     * @return mixed
     */
    public function startCleanerTask($user_id = 0, $task_id = 0, $start_time = '', $schedule_task_id = 0)
    {
        $cleaner = Cleaner::where('user_id', '=', $user_id)->first();

        $cleaner_schedule = CleanerSchedule::create([
            'cleaner_id' => $cleaner->id,
            'task_id' => $task_id,
            'start_time' => $start_time
        ]);

        $task_status = TaskStatus::create([
            'cleaner_schedule_id' => $cleaner_schedule->id,
            'schedule_task_id' => $schedule_task_id,
            'status' => 'STARTED',
            'date' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return $cleaner_schedule;

    }

    /**
     * @param int $schedule_id
     * @param string $current_date
     * @param int $schedule_task_id
     * @return mixed
     */
    public function endCleanerTask($schedule_id = 0, $current_date = '', $schedule_task_id = 0)
    {
        $cleaner_schedule = CleanerSchedule::where('id', '=', $schedule_id)->update(['end_time' => $current_date]);

        $task_status = TaskStatus::create([
            'cleaner_schedule_id' => $schedule_id,
            'schedule_task_id' => $schedule_task_id,
            'status' => 'FINISHED',
            'date' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return $cleaner_schedule;
    }

    /**
     * @param int $user_id
     * @param int $task_id
     * @return mixed
     */
    public function getCleanerInventory($user_id = 0, $task_id = 0)
    {
        $cleaner = Cleaner::where('user_id', '=', $user_id)->first();
        return DB::table('products')
            ->join('client_product', 'products.id', '=', 'client_product.product_id')
            ->join('tasks', 'client_product.client_id', '=', 'tasks.client_id')
            ->join('cleaner_task', 'tasks.id', '=', 'cleaner_task.task_id')
            ->where('cleaner_task.cleaner_id', '=', $cleaner->id)
            ->where('tasks.id', '=', $task_id)
            ->get([
                'products.*',
                'products.qty as product_quantity',
                'client_product.quantity as qty'
            ]);
    }

    /**
     * @param int $user_id
     * @return mixed
     * @todo add inspector_task table and link it with inspector assigned tasks
     */
    public function getInspectorTasks($user_id = 0)
    {
        return DB::table('tasks')
//            ->join('client_task', 'tasks.id', '=', 'client_task.task_id')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
            ->join('inspector_task', 'tasks.id', '=', 'inspector_task.task_id')
            ->join('inspectors', 'inspector_task.inspector_id', '=', 'inspectors.id')
            ->where('inspectors.user_id', '=', $user_id)
            ->where('tasks.status', '=', 'active')
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->get([
                'tasks.id as task_id',
                'tasks.name as task_name',
                'clients.id as client_id',
                'clients.name as client_first_name',
            ]);
    }

    /**
     * @param int $user_id
     * @param int $task_id
     * @param string $start_time
     * @return mixed
     */
    public function startInspectorTask($user_id = 0, $task_id = 0, $start_time = '')
    {
        $inspector = Inspector::where('user_id', '=', $user_id)->first();
        return InspectorSchedule::create([
            'inspector_id' => $inspector->id,
            'task_id' => $task_id,
            'start_time' => $start_time
        ]);
    }

    /**
     * @param int $schedule_id
     * @param string $current_date
     * @return mixed
     */
    public function endInspectorTask($schedule_id = 0, $current_date = '')
    {
        return InspectorSchedule::where('id', '=', $schedule_id)->update(['end_time' => $current_date]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getInspectorInventory($task_id = 0, $user_id = 0)
    {
        $inspector = Inspector::where('user_id', '=', $user_id)->first();
        return DB::table('products')
            ->join('client_product', 'products.id', '=', 'client_product.product_id')
            ->join('tasks', 'client_product.client_id', '=', 'tasks.client_id')
            ->join('inspector_task', 'tasks.id', '=', 'inspector_task.task_id')
            ->where('inspector_task.inspector_id', '=', $inspector->id)
            ->where('tasks.id', '=', $task_id)
            ->get([
                'products.*',
                'client_product.quantity as task_quantity'
            ]);
    }

    /**
     * @param int $user_id
     * @return mixed
     * @todo create finished tasks with new reference method
     */
    public function getFinishedTasks($user_id = 0)
    {
        return DB::select(DB::raw("SELECT MAX(schedules.start_time)      AS start_time,
       MAX(schedules.end_time)        AS end_time,
       MAX(clients.name)              AS client_first_name,
       MAX(tasks.id)                  AS task_id,
       count(distinct(task_items.id)) AS task_count,
       max(tasks.address)             AS task_address,
       max(tasks.latitude)            AS latitude,
       max(tasks.longitude)           AS longitude
FROM tasks
       INNER JOIN clients ON tasks.client_id = clients.id
       INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
       INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
       INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
       INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
       INNER JOIN task_items ON tasks.id = task_items.task_id
WHERE cleaners.user_id = '" . $user_id . "'
  AND (schedules.`repeat` IS FALSE && schedules.end_time < now())
  AND clients.deleted_at IS NULL
GROUP BY tasks.id
# LIMIT 5"));
    }

    /**
     * @param int $user_id
     * @param int $client_id
     * @param string $date
     * @return mixed
     */
    public function getChecklistForCleaner($user_id = 0, $client_id = 0, $date = '')
    {
        return DB::table('tasks')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
            ->join('cleaner_task', 'tasks.id', '=', 'cleaner_task.task_id')
            ->join('cleaners', 'cleaner_task.cleaner_id', '=', 'cleaners.id')
            ->where('cleaners.user_id', '=', $user_id)
            ->where('clients.id', '=', $client_id)
            ->whereRaw(DB::raw("date(schedules.start_time) = '" . $date . "'"))
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->get([
                'tasks.id',
                'schedules.start_time',
                'tasks.name   AS task_name',
                'clients.name AS client_first_name',
            ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getChecklistItems($task_id = 0)
    {
        return TaskItem::where('task_id', '=', $task_id)
            ->get();
    }

    /**
     * @param int $task_id
     * @param int $cleaner_id
     * @return mixed
     */
    public function getCleanerTaskItems($task_id = 0, $cleaner_id = 0)
    {
        return DB::table('task_items')
//            ->join('cleaner_schedules', 'task_items.task_id', '=', 'cleaner_schedules.task_id')
            ->where('task_items.task_id', '=', $task_id)
//            ->where('cleaner_schedules.cleaner_id', '=', $cleaner_id)
//            ->groupBy('task_items.id')
            ->get([
                DB::raw('task_items.id   AS task_item_id'),
                DB::raw('task_items.name AS task_item_name'),
                DB::raw('task_items.checked AS checked'),
            ]);
    }

    /**
     * @param int $task_item_id
     * @param int $cleaner_id
     * @return mixed
     */
    public function getTaskItemImages($task_item_id = 0, $cleaner_id = 0)
    {
        return DB::table('media')
            ->join('cleaner_schedule_media', 'media.id', '=', 'cleaner_schedule_media.media_id')
            ->join('cleaner_schedules', 'cleaner_schedule_media.cleaner_schedule_id', '=', 'cleaner_schedules.id')
            ->where('cleaner_schedule_media.task_item_id', '=', $task_item_id)
            ->where('cleaner_schedules.cleaner_id', '=', $cleaner_id)
            ->get([
                'media.name AS image_name',
                'media.path AS image_path',
            ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTaskList($task_id = 0)
    {
        return TaskItem::where('task_id', '=', $task_id)->get();
    }

    /**
     * @param string $image_name
     * @param string $image_path
     * @return mixed
     */
    public function createImage($image_name = '', $image_path = '')
    {
        return Media::create([
            'name' => $image_name,
            'path' => $image_path
        ]);
    }

    /**
     * @param int $image_id
     * @param int $cleaner_schedule_id
     * @param int $task_item_id
     * @return mixed
     */
    public function createCleanerScheduleImage($image_id = 0, $cleaner_schedule_id = 0, $task_item_id = 0)
    {
        return CleanerScheduleMedia::create([
            'media_id' => $image_id,
            'cleaner_schedule_id' => $cleaner_schedule_id,
            'task_item_id' => $task_item_id
        ]);
    }

    /**
     * @param int $task_item_id
     * @param int $checked
     * @param int $schedule_task_id
     * @param int $cleaner_schedule_id
     * @return mixed
     */
    public function updateTaskItemCompletion($task_item_id = 0, $checked = 0, $schedule_task_id = 0, $cleaner_schedule_id = 0)
    {

        $task_item_status = TaskItemStatus::create([
            'task_item_id' => $task_item_id,
            'schedule_task_id' => $schedule_task_id,
            'cleaner_schedule_id' => $cleaner_schedule_id,
            'status' => 'FINISHED',
            'date' => Carbon::today()->format('Y-m-d'),
        ]);

        return TaskItem::where('id', '=', $task_item_id)->update([
            'checked' => $checked
        ]);
    }

    /**
     * @param int $product_id
     * @param int $quantity
     * @return mixed
     */
    public function updateInventory($product_id = 0, $quantity = 0)
    {
        return Product::where('id', '=', $product_id)->update([
            'qty' => $quantity
        ]);
    }

    /**
     * @param int $product_id
     * @param int $client_id
     * @param int $quantity
     * @return mixed
     */
    public function updateClientInventory($product_id = 0, $client_id = 0, $quantity = 0)
    {
        return DB::table('client_product')
            ->where('client_id', '=', $client_id)
            ->where('product_id', '=', $product_id)
            ->update([
                'quantity' => $quantity
            ]);
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getScheduleByTask($task_id = 0)
    {
        return DB::table('schedule_task')->where('task_id', '=', $task_id)->first(['id']);
    }

    /**
     * @param int $cleaner_schedule_id
     * @return mixed
     */
    public function getTaskStatus($cleaner_schedule_id = 0)
    {
        return TaskStatus::where('cleaner_schedule_id', '=', $cleaner_schedule_id)->first(['schedule_task_id']);
    }

    /**
     * @param int $task_item_id
     * @return mixed
     */
    public function getTaskScheduleByTaskItem($task_item_id = 0)
    {
        return DB::table('schedule_task')
            ->join('task_items', 'schedule_task.task_id', '=', 'task_items.task_id')
            ->where('task_items.id', '=', $task_item_id)
            ->first(['schedule_task.id AS schedule_task_id']);
    }

    /**
     * @param int $product_id
     * @return mixed
     */
    public function getProductQuantity($product_id = 0)
    {
        return Product::where('id', '=', $product_id)->first(['qty']);
    }

    /**
     * @param int $product_id
     * @param int $client_id
     * @return mixed
     */
    public function getClientProductQuantity($product_id = 0, $client_id = 0)
    {
        return DB::table('client_product')
            ->where('client_id', '=', $client_id)
            ->where('product_id', '=', $product_id)
            ->first();
    }

    /**
     * @param int $product_id
     * @param int $task_id
     * @return mixed
     */
    public function getTaskProduct($product_id = 0, $task_id = 0)
    {
        return TaskProduct::where('product_id', '=', $product_id)
            ->where('task_id', '=', $task_id)
            ->first();
    }

    /**
     * @param int $task_product_id
     * @param int $task_product_quantity
     * @return mixed
     */
    public function updateTaskProducts($task_product_id = 0, $task_product_quantity = 0)
    {
        return TaskProduct::where('id', '=', $task_product_id)->update([
            'qty' => $task_product_quantity
        ]);
    }

    /**
     * @param int $cleaner_schedule_id
     * @return mixed
     */
    public function getTaskByCleanerSchedule($cleaner_schedule_id = 0)
    {
        return CleanerSchedule::where('id', '=', $cleaner_schedule_id)
            ->first(['task_id']);
    }

    /**
     * @param int $product_id
     * @param int $cleaner_schedule_id
     * @param int $quantity
     * @return mixed
     */
    public function addNewCleanerScheduleProduct($product_id = 0, $cleaner_schedule_id = 0, $quantity = 0)
    {
        return CleanerScheduleProduct::create([
            'product_id' => $product_id,
            'cleaner_schedule_id' => $cleaner_schedule_id,
            'quantity' => $quantity,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
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
     * @param int $task_item_id
     * @return mixed
     */
    public function getCleanerTaskItemStatus($task_item_id = 0)
    {
        return TaskItemStatus::where('task_item_id', '=', $task_item_id)
            ->where('status', '=', 'FINISHED')
            ->count();
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function checkTaskFinished($task_id = 0)
    {
        return DB::table('task_status')
            ->join('cleaner_schedules', 'task_status.cleaner_schedule_id', '=', 'cleaner_schedules.id')
            ->where('task_status.status', '=', 'FINISHED')
            ->where('cleaner_schedules.task_id', '=', $task_id)
            ->count();
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function checkTaskFinishedToday($task_id = 0)
    {
        return DB::table('task_status')
            ->join('cleaner_schedules', 'task_status.cleaner_schedule_id', '=', 'cleaner_schedules.id')
            ->where('task_status.status', '=', 'FINISHED')
            ->where('cleaner_schedules.task_id', '=', $task_id)
            ->whereRaw('date(start_time) = curdate()')
            ->count();
    }

    public function getLatestTaskFinishedStatus($task_id = 0)
    {
        return DB::table('task_status')
            ->join('cleaner_schedules', 'task_status.cleaner_schedule_id', '=', 'cleaner_schedules.id')
            ->where('task_status.status', '=', 'FINISHED')
            ->where('cleaner_schedules.task_id', '=', $task_id)
            ->orderBy('start_time', 'desc')
            ->first();
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getRepeatSchedules($user_id = 0)
    {
        return DB::select(DB::raw("SELECT
  schedules.`repeat`,
  schedules.repeat_mode,
  schedules.start_time,
  schedules.end_time,
  clients.id
FROM clients
  INNER JOIN tasks ON clients.id = tasks.client_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
  WHERE inspectors.user_id = $user_id AND schedules.`repeat` IS TRUE and clients.deleted_at is NULL;"));
    }

    /**
     * @param string $conditions
     * @param int $user_id
     * @return mixed
     */
    public function getClientsByDate($conditions = '', $user_id = 0)
    {
        return DB::select(DB::raw("SELECT
  max(clients.id)            AS client_id,
  max(clients.name)          AS client_first_name,
  max(clients.street_number) AS street_number,
  max(clients.street_name)   AS street_name,
  max(clients.city)          AS city,
  max(clients.post_code)     AS post_code,
  max(categories.name)       as class
FROM clients
  INNER JOIN tasks ON clients.id = tasks.client_id
  LEFT JOIN cleaner_schedules ON tasks.id = cleaner_schedules.task_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
  inner join categories on clients.category_id = categories.id
  WHERE 1 = 1 AND $conditions AND inspectors.user_id = $user_id and clients.deleted_at IS NULL
GROUP BY clients.id;"));
    }

    /**
     * @param string $conditions
     * @return mixed
     */
    public function getAllClientsByDate($conditions = '')
    {
        return DB::select(DB::raw("SELECT max(clients.id)            AS client_id,
       max(clients.name)          AS client_first_name,
       max(clients.street_number) AS street_number,
       max(clients.street_name)   AS street_name,
       max(clients.city)          AS city,
       max(clients.post_code)     AS post_code,
       max(categories.name)       as class
FROM clients
       INNER JOIN tasks ON clients.id = tasks.client_id
       LEFT JOIN cleaner_schedules ON tasks.id = cleaner_schedules.task_id
       INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
       INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
       INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
       INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
       inner join categories on clients.category_id = categories.id
  WHERE 1 = 1 AND $conditions and clients.deleted_at IS NULL
GROUP BY clients.id;"));
    }


    /**
     * @param int $client_id
     * @param int $user_id
     * @return mixed
     */
    public function getNonStartedClientTasks($client_id = 0, $user_id = 0)
    {
        return DB::select(DB::raw("SELECT
  max(tasks.id)              AS task_id,
  max(name)                  AS name,
  max(schedules.start_time)  AS start_time,
  max(schedules.end_time)    AS end_time,
  max(cleaners.id)           AS cleaner_id,
  max(cleaners.first_name)   AS cleaner_first_name,
  max(cleaners.last_name)    AS cleaner_last_name,
  max(tasks.address)         AS task_address,
  max(tasks.latitude)        AS latitude,
  max(tasks.longitude)       AS longitude,
  max(schedules.repeat_mode) AS repeat_mode,
  max(schedules.repeat)      AS task_repeat
FROM tasks
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_id = schedules.id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  LEFT JOIN cleaner_schedules ON tasks.id = cleaner_schedules.task_id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE client_id = '" . $client_id . "' AND cleaner_schedules.task_id IS NULL AND inspectors.user_id = $user_id AND cleaners.deleted_at IS NULL
GROUP BY tasks.id"));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getAllNonStartedClientTasks($client_id = 0)
    {
        return DB::select(DB::raw("SELECT
  max(tasks.id)              AS task_id,
  max(name)                  AS name,
  max(schedules.start_time)  AS start_time,
  max(schedules.end_time)    AS end_time,
  max(cleaners.id)           AS cleaner_id,
  max(cleaners.first_name)   AS cleaner_first_name,
  max(cleaners.last_name)    AS cleaner_last_name,
  max(tasks.address)         AS task_address,
  max(tasks.latitude)        AS latitude,
  max(tasks.longitude)       AS longitude,
  max(schedules.repeat_mode) AS repeat_mode,
  max(schedules.repeat)      AS task_repeat
FROM tasks
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_id = schedules.id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  LEFT JOIN cleaner_schedules ON tasks.id = cleaner_schedules.task_id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE client_id = '" . $client_id . "' AND cleaner_schedules.task_id IS NULL AND cleaners.deleted_at IS NULL
GROUP BY tasks.id"));
    }

    /**
     * @param int $client_id
     * @param int $user_id
     * @return mixed
     */
    public function getIncompleteClientTasks($client_id = 0, $user_id = 0)
    {
        return DB::select(DB::raw("SELECT
  max(tasks.id)             AS task_id,
  max(name)                 AS name,
  max(schedules.start_time) AS start_time,
  max(schedules.end_time)   AS end_time,
  max(cleaners.id)          AS cleaner_id,
  max(cleaners.first_name)  AS cleaner_first_name,
  max(cleaners.last_name)   AS cleaner_last_name,
  max(tasks.address)        AS task_address,
  max(tasks.latitude)       AS latitude,
  max(tasks.longitude)      AS longitude,
  max(schedules.repeat_mode) AS repeat_mode,
  max(schedules.repeat)      AS task_repeat
FROM tasks
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_id = schedules.id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  INNER JOIN cleaner_schedules ON tasks.id = cleaner_schedules.task_id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE client_id = " . $client_id . " AND inspectors.user_id = $user_id  AND cleaners.deleted_at IS NULL
GROUP BY tasks.id"));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getAllIncompleteClientTasks($client_id = 0)
    {
        return DB::select(DB::raw("SELECT
  max(tasks.id)             AS task_id,
  max(name)                 AS name,
  max(schedules.start_time) AS start_time,
  max(schedules.end_time)   AS end_time,
  max(cleaners.id)          AS cleaner_id,
  max(cleaners.first_name)  AS cleaner_first_name,
  max(cleaners.last_name)   AS cleaner_last_name,
  max(tasks.address)        AS task_address,
  max(tasks.latitude)       AS latitude,
  max(tasks.longitude)      AS longitude,
  max(schedules.repeat_mode) AS repeat_mode,
  max(schedules.repeat)      AS task_repeat
FROM tasks
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_id = schedules.id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  INNER JOIN cleaner_schedules ON tasks.id = cleaner_schedules.task_id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE client_id = " . $client_id . " AND cleaners.deleted_at IS NULL
GROUP BY tasks.id"));
    }

    /**
     * @param int $client_id
     * @param int $user_id
     * @return mixed
     */
    public function getClientFinishedTasks($client_id = 0, $user_id = 0)
    {
        return DB::select(DB::raw("SELECT
  max(tasks.id)             AS task_id,
  max(name)                 AS name,
  max(schedules.start_time) AS start_time,
  max(schedules.end_time)   AS end_time,
  max(cleaners.id)          AS cleaner_id,
  max(cleaners.first_name)  AS cleaner_first_name,
  max(cleaners.last_name)   AS cleaner_last_name,
  max(tasks.address)        AS task_address,
  max(tasks.latitude)       AS latitude,
  max(tasks.longitude)      AS longitude,
  max(schedules.repeat_mode) AS repeat_mode,
  max(schedules.repeat)      AS task_repeat
FROM tasks
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_id = schedules.id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE client_id = " . $client_id . " AND inspectors.user_id = $user_id  AND cleaners.deleted_at IS NULL
GROUP BY tasks.id"));
    }

    /**
     * @param int $client_id
     * @param int $user_id
     * @return mixed
     */
    public function getAllClientFinishedTasks($client_id = 0)
    {
        return DB::select(DB::raw("SELECT
  max(tasks.id)             AS task_id,
  max(name)                 AS name,
  max(schedules.start_time) AS start_time,
  max(schedules.end_time)   AS end_time,
  max(cleaners.id)          AS cleaner_id,
  max(cleaners.first_name)  AS cleaner_first_name,
  max(cleaners.last_name)   AS cleaner_last_name,
  max(tasks.address)        AS task_address,
  max(tasks.latitude)       AS latitude,
  max(tasks.longitude)      AS longitude,
  max(schedules.repeat_mode) AS repeat_mode,
  max(schedules.repeat)      AS task_repeat
FROM tasks
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_id = schedules.id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE client_id = " . $client_id . " AND cleaners.deleted_at IS NULL
GROUP BY tasks.id"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTaskFinishedStatus($task_id = 0)
    {
        return DB::select(DB::raw("SELECT *
FROM task_status
  INNER JOIN schedule_task ON task_status.schedule_task_id = schedule_task.id
WHERE task_id = " . $task_id));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getTaskItemStatus($task_id = 0)
    {
        return DB::select(DB::raw("SELECT *
FROM task_items
  LEFT JOIN task_item_status ON task_items.id = task_item_status.task_item_id
WHERE task_id = " . $task_id));
    }

    /**
     * @param int $client_id
     * @param int $user_id
     * @return mixed
     */
    public function getTaskCount($client_id = 0, $user_id = 0)
    {
        return DB::select(DB::raw("SELECT max(tasks.id) AS task_id
FROM tasks
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE client_id = $client_id AND inspectors.user_id = $user_id
GROUP BY tasks.id"));
    }

    public function getAllTaskCount($client_id = 0)
    {
        return DB::select(DB::raw("SELECT max(tasks.id) AS task_id
FROM tasks
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE client_id = $client_id
GROUP BY tasks.id"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getClientTaskItems($task_id = 0)
    {
        return DB::select(DB::raw("SELECT *
FROM task_items
WHERE task_id = " . $task_id));
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
     * @return mixed
     */
    public function getTaskRepeatStatus($task_id = 0)
    {
        return DB::table('tasks')
            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
            ->where('tasks.id', '=', $task_id)
            ->first([
                'repeat',
                'repeat_mode'
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
     * @return mixed
     */
    public function getTaskSchedule($task_id = 0)
    {
        return DB::select(DB::raw("SELECT schedules.*
FROM schedules
  INNER JOIN schedule_task ON schedules.id = schedule_task.schedule_id
WHERE task_id = '$task_id';"));
    }

    /**
     * @param int $cleaner_schedule_id
     * @param string $audio
     * @param string $time
     * @return mixed
     */
    public function createAudio(int $cleaner_schedule_id, string $audio, string $time)
    {
        return DB::table('cleaner_schedule_audio')->insert([
            'cleaner_schedule_id' => $cleaner_schedule_id,
            'audio' => $audio,
            'date' => $time,
            'notification' => true,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function getTaskByName(string $message)
    {
        return Task::where('name', 'like', $message)->first();
    }

    /**
     * @param int $task_id
     * @param string $date
     * @return mixed
     */
    public function getCleanerSchedule(int $task_item_id, string $date)
    {
        return DB::select(DB::raw("select *
from cleaner_schedules
       inner join task_item_status on cleaner_schedules.id = task_item_status.cleaner_schedule_id
where date(start_time) = '$date'
  and task_item_id = $task_item_id
  and start_time is not null
  and end_time is not null;"));
    }

    /**
     * @param int $task_id
     * @param string $date
     * @return mixed
     */
    public function getCleanerScheduleByTask(int $task_id, string $date)
    {
        return DB::select(DB::raw("select *
from cleaner_schedules
where date(start_time) = $date
  and task_id = $task_id
  and start_time is not null
  and end_time is not null;"));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getCleanDates(int $client_id)
    {
        return DB::select(DB::raw("select *
from cleaner_schedules
       inner join tasks on cleaner_schedules.task_id = tasks.id
where client_id = $client_id
order by cleaner_schedules.start_time desc
limit 1;"));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getInspectionDates(int $client_id)
    {
        return DB::select(DB::raw("select *
from inspector_schedules
       inner join tasks on inspector_schedules.task_id = tasks.id
where client_id = $client_id
order by inspector_schedules.start_time desc
limit 1;"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getCleanerTask(int $task_id)
    {
        return DB::select(DB::raw("select * from cleaner_task where task_id = $task_id"));
    }

    /**
     * @param int $task_id
     * @param int $cleaner_id
     * @return mixed
     */
    public function getAudio(int $task_id, int $cleaner_id)
    {
        return DB::select(DB::raw("select cleaner_schedule_audio.*
from cleaner_schedule_audio
       inner join cleaner_schedules on cleaner_schedule_audio.cleaner_schedule_id = cleaner_schedules.id
where task_id = $task_id
  and cleaner_id = $cleaner_id
order by cleaner_schedule_audio.id desc
limit 1;"));
    }

    /**
     * @param string $date
     * @return mixed
     */
    public function getOneTimeTasks(string $date)
    {
        return DB::select(DB::raw("select tasks.*, schedules.*
from tasks
         inner join schedule_task on tasks.id = schedule_task.task_id
         inner join schedules on schedule_task.schedule_id = schedules.id
where `repeat` is false
  and date(start_time) = '$date';"));
    }

    /**
     * @return mixed
     */
    public function getRepeatedTasks()
    {
        return DB::select(DB::raw("select tasks.*, schedules.*
from tasks
         inner join schedule_task on tasks.id = schedule_task.task_id
         inner join schedules on schedule_task.schedule_id = schedules.id
where `repeat` is true;"));
    }

    public function getCleanerScheduleById(int $schedule_id)
    {
        return CleanerSchedule::whereId($schedule_id)->first();
    }
}