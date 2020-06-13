<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/23/2017
 * Time: 11:45 AM
 */

namespace App\Repositories;

use App\Client;
use Illuminate\Support\Facades\DB;

/**
 * Class RestCalendarRepository
 * @package App\Repositories
 */
class RestCalendarRepository
{
    /**
     * @param int $client_id
     * @param string $start_date
     * @return mixed
     */
    public function getChecklist($client_id = 0, $start_date = '')
    {
        return DB::table('tasks')
            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
//            ->where('tasks.status', '=', 'ACTIVE')
            ->where('clients.id', '=', $client_id)
            ->whereRaw(DB::raw("DATE(schedules.start_time) = '" . $start_date . "'"))
            ->get([
                'clients.id            AS client_id',
                'clients.name    AS client_first_name',
                'tasks.id              AS task_id',
                'tasks.name            AS task_name',
                'schedules.repeat      AS schedule_repeat',
                'schedules.repeat_mode AS schedule_repeat_mode',
                'schedules.start_time  AS schedule_start_time',
                'schedules.end_time    AS schedule_end_time',
            ]);
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getInventory($client_id = 0)
    {
        return DB::table('products')
            ->join('client_product', 'products.id', '=', 'client_product.product_id')
            ->where('client_product.client_id', '=', $client_id)
            ->get([
                'products.name AS product_name',
                'price',
                'client_product.quantity  AS product_qty',
                'units'
            ]);
    }

    /**
     * @return mixed
     */
    public function getClients()
    {
        return Client::get(['clients.*', 'clients.name as first_name']);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getCleanerClients($user_id = 0)
    {
        return DB::table('clients')
            ->join('tasks', 'clients.id', '=', 'tasks.client_id')
            ->join('cleaner_task', 'tasks.id', '=', 'cleaner_task.task_id')
            ->join('cleaners', 'cleaner_task.cleaner_id', '=', 'cleaners.id')
            ->where('cleaners.user_id', '=', $user_id)
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->groupBy('clients.id')
            ->get([
                DB::raw('max(clients.id) as id'),
                DB::raw('max(clients.name) as first_name'),
            ]);
    }
}