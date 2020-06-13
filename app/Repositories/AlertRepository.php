<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/16/2017
 * Time: 4:19 PM
 */

namespace App\Repositories;

use App\Alert;
use Illuminate\Support\Facades\DB;

/**
 * Class AlertRepository
 * @package App\Repositories
 */
class AlertRepository
{
    /**
     * @return mixed
     */
    public function getAlerts()
    {
        return Alert::orderBy('date', 'desc')
//            ->withTrashed()
            ->where('type', '=', 'cleaner')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getAllAlerts()
    {
        return Alert::orderBy('date', 'desc')->get();
    }

    /**
     * @param string $title
     * @param string $message
     * @param string $type
     * @param string $date
     * @return mixed
     */
    public function createAlert($title = '', $message = '', $type = '', $date = '')
    {
        return Alert::create([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'date' => $date,

        ]);
    }

    /**
     * @param int $alert_id
     * @return mixed
     */
    public function getAlert($alert_id = 0)
    {
        return Alert::where('id', '=', $alert_id)->first();
    }

    /**
     * @param int $alert_id
     * @param string $title
     * @param string $message
     * @param string $type
     * @param string $date
     * @param string $status
     * @return mixed
     */
    public function updateAlert($alert_id = 0, $title = '', $message = '', $type = '', $date = '', $status = '')
    {
        return Alert::where('id', '=', $alert_id)->update([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'date' => $date,
            'status' => $status,
        ]);
    }

    /**
     * @param int $alert_id
     * @return string
     */
    public function deleteAlert($alert_id = 0)
    {
        try {
            return Alert::where('id', '=', $alert_id)->delete();
        } catch (Exception $exception) {
            return 'key';
        }
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

    /**
     * @param int $alert_id
     * @param int $inspector_id
     * @param string $time
     * @return mixed
     */
    public function assignAlertToInspector($alert_id = 0, $inspector_id = 0, $time = '')
    {
        return DB::table('inspector_alert')->insert([
            'alert_id' => $alert_id,
            'inspector_id' => $inspector_id,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    /**
     * @param string $alert
     * @return mixed
     */
    public function deleteAlertByName(string $alert)
    {
        return Alert::where('message', '=', $alert)->delete();
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function getAlertByName(string $message)
    {
        return Alert::where('message', 'like', $message);
    }
}