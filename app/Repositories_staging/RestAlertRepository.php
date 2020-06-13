<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/3/2018
 * Time: 6:55 PM
 */

namespace App\Repositories;

use App\Alert;
use App\Product;
use Illuminate\Support\Facades\DB;

/**
 * Class RestAlertRepository
 * @package App\Repositories
 */
class RestAlertRepository
{
    /**
     * @param int $cleaner_id
     * @return mixed
     */
    public function getCleanerAlerts(int $cleaner_id)
    {
        return DB::table('alerts')
            ->join('cleaner_alert', 'alerts.id', '=', 'cleaner_alert.alert_id')
            ->where('cleaner_alert.cleaner_id', '=', $cleaner_id)
            ->whereNull('alerts.deleted_at')
            ->orderBy('alerts.id', 'desc')
            ->get([
                'alerts.id AS alert_id',
                'title',
                'message',
                'type',
                'date'
            ]);
    }

    /**
     * @param int $inspector_id
     * @return mixed
     */
    public function getInspectorAlerts(int $inspector_id)
    {
        return DB::table('alerts')
            ->join('inspector_alert', 'alerts.id', '=', 'inspector_alert.alert_id')
            ->where('inspector_alert.inspector_id', '=', $inspector_id)
            ->whereNull('alerts.deleted_at')
            ->orderBy('alerts.id', 'desc')
            ->get([
                'alerts.id AS alert_id',
                'title',
                'message',
                'type',
                'date'
            ]);
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getCleanerInventory($user_id)
    {
        return DB::table('products')
            ->join('client_product', 'products.id', '=', 'client_product.product_id')
            ->join('cleaner_task', 'client_product.task_id', '=', 'cleaner_task.task_id')
            ->join('cleaners', 'cleaner_task.cleaner_id', '=', 'cleaners.id')
            ->where('cleaners.user_id', '=', $user_id)
            ->get(['products.*']);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getInspectorInventory($user_id = 0)
    {
        return Product::get();
    }

    /**
     * @param int $alert_id
     * @return mixed
     */
    public function getAlert(int $alert_id)
    {
        return Alert::where('id', '=', $alert_id)->first();
    }

    /**
     * @param int $alert_id
     * @param int $cleaner_id
     * @param string $time
     * @return mixed
     */
    public function assignAlertToCleaner($alert_id = 0, $cleaner_id = 0, $time = '')
    {
        return DB::table('cleaner_alert')->insert([
            'alert_id' => $alert_id,
            'cleaner_id' => $cleaner_id,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    public function createAlert($title = '', $message = '', $type = '', $date = '')
    {
        return Alert::create([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'date' => $date,

        ]);
    }
}