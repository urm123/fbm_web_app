<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 1/26/2018
 * Time: 5:23 PM
 */

namespace App\Repositories;

use App\Cleaner;
use App\Client;
use App\Inspector;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class RestUserRepository
 * @package App\Repositories
 */
class RestUserRepository
{
    /**
     * @param int $user_id
     * @param string $yesterday
     * @return mixed
     */
    public function getCleaners($user_id = 0, $yesterday = '')
    {
        return DB::select(DB::raw("SELECT
  max(cleaners.first_name)  AS first_name,
  max(cleaners.last_name)   AS last_name,
  count(clients.id)         AS client_count,
  max(cleaners.id)          AS cleaner_id,
  max(schedules.start_time) AS start_time,
  max(schedules.end_time)   AS end_time
FROM cleaners
  INNER JOIN cleaner_task ON cleaners.id = cleaner_task.cleaner_id
  INNER JOIN tasks ON cleaner_task.task_id = tasks.id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
  INNER JOIN clients ON tasks.client_id = clients.id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
WHERE inspectors.user_id = '" . $user_id . "' AND date(schedules.start_time) < '" . $yesterday . "'  AND cleaners.deleted_at IS NULL AND clients.deleted_at IS NULL
GROUP BY cleaners.id
ORDER BY max(schedules.start_time) DESC
LIMIT 5"));
    }

    /**
     * @param int $user_id
     * @param string $date
     * @return mixed
     */
    public function getCleanersByDate($user_id = 0, $date = '')
    {
        return DB::select(DB::raw("SELECT
  max(cleaners.first_name)  AS first_name,
  max(cleaners.last_name)   AS last_name,
  count(clients.id)         AS client_count,
  max(cleaners.id)          AS cleaner_id,
  max(schedules.start_time) AS start_time,
  max(schedules.end_time)   AS end_time
FROM cleaners
  INNER JOIN cleaner_task ON cleaners.id = cleaner_task.cleaner_id
  INNER JOIN tasks ON cleaner_task.task_id = tasks.id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
  INNER JOIN clients ON tasks.client_id = clients.id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
WHERE inspectors.user_id = '" . $user_id . "' AND date(schedules.start_time) = '" . $date . "'  AND cleaners.deleted_at IS NULL  AND clients.deleted_at IS NULL
GROUP BY cleaners.id"));
    }

    /**
     * @param int $cleaner_id
     * @return mixed
     */
    public function getUserIdByCleaner($cleaner_id = 0)
    {
        return Cleaner::where('id', '=', $cleaner_id)->first(['user_id']);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getUserStatus($user_id = 0)
    {
        return DB::table('oauth_access_tokens')
            ->where('user_id', '=', $user_id)
            ->count();
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getUser($user_id = 0)
    {
        return User::where('id', '=', $user_id)->first();
    }

    /**
     * @param int $user_id
     * @param string $password
     * @return mixed
     */
    public function updateUserPassword($user_id = 0, $password = '')
    {
        return User::where('id', '=', $user_id)->update([
            'password' => $password
        ]);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getCleaner($user_id = 0)
    {
        return Cleaner::where('user_id', '=', $user_id)->first();
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getInspector($user_id = 0)
    {
        return Inspector::where('user_id', '=', $user_id)->first();
    }

    /**
     * @param int $user_id
     * @param string $first_name
     * @param string $last_name
     * @param string $telephone
     * @param string $mobile
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $postal_code
     * @param string $image
     * @return mixed
     */
    public function updateCleaner($user_id = 0, $first_name = '', $last_name = '', $telephone = '', $mobile = '', $street_number = '', $street_name = '', $city = '', $postal_code = '', $image = '')
    {
        return Cleaner::where('user_id', '=', $user_id)->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'city' => $city,
            'post_code' => $postal_code,
            'image' => $image,
        ]);
    }

    /**
     * @param int $user_id
     * @param string $first_name
     * @param string $last_name
     * @param string $telephone
     * @param string $mobile
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $postal_code
     * @param string $image
     * @return mixed
     */
    public function updateInspector($user_id = 0, $first_name = '', $last_name = '', $telephone = '', $mobile = '', $street_number = '', $street_name = '', $city = '', $postal_code = '', $image = '')
    {
        return Inspector::where('user_id', '=', $user_id)->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'city' => $city,
            'post_code' => $postal_code,
            'image' => $image,
        ]);
    }

    /**
     * @param int $user_id
     * @param string $username
     * @return mixed
     */
    public function updateUserName($user_id = 0, $username = '')
    {
        return User::where('id', '=', $user_id)->update([
            'name' => $username
        ]);
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getClient($client_id = 0)
    {
        return Client::where('id', '=', $client_id)->first();
    }
}