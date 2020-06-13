<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/27/2017
 * Time: 3:06 PM
 */

namespace App\Repositories;

use App\AccountingContact;
use App\Admin;
use App\Cleaner;
use App\CleanerTimes;
use App\CleanerCheckList;
use App\CleanerCheckListItems;
use App\Client;
use App\Inspector;
use App\Menu;
use App\OperationalContact;
use App\TaskItem;
use App\User;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @param int $level
     * @return mixed
     */
    public function getAdministrators($level = 0)
    {
        return DB::table('users')
            ->join('admins', 'users.id', '=', 'admins.user_id')
            ->where('users.role', '=', 'admin')
            ->where('admins.level', '>', $level)
            ->whereRaw(DB::raw('admins.deleted_at IS NULL'))
            ->get([
                'users.id',
                'users.name',
                'users.email',
                'admins.first_name',
                'admins.last_name',
                'admins.telephone',
                'admins.level',
                'admins.street_number',
                'admins.street_name',
                'admins.city',
                'admins.post_code',
                'admins.pan_number',
                'admins.initial_password',
            ]);
    }

    /**
     * @return mixed
     */
    public function getAdministratorDetails()
    {
        return DB::select(DB::raw("SELECT *, CONCAT(first_name,' ',last_name) AS name
FROM admins
  INNER JOIN users ON admins.user_id = users.id WHERE admins.deleted_at IS NULL;"));
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $postal_code
     * @param string $telephone
     * @param string $mobile
     * @param string $agreement_start
     * @param string $level
     * @param string $initial_password
     * @param string $user_type
     * @return mixed
     */
    public function addNewAdministrator($username = '', $password = '', $email = '', $first_name = '', $last_name = '', $street_number = '', $street_name = '', $city = '', $postal_code = '', $telephone = '', $mobile = '', $agreement_start = '', $level = '', $initial_password = '', $user_type = '')
    {
        $user = User::create([
            'name' => $username,
            'password' => $password,
            'email' => $email,
            'role' => 'ADMIN',
            'role_id' => $user_type,
        ]);

        return Admin::create([
            'user_id' => $user->id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'city' => $city,
            'post_code' => $postal_code,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'agreement_start' => $agreement_start,
            'level' => $level,
            'pan_number' => 'FBM 000' . $user->id,
            'initial_password' => $initial_password,
        ]);
    }

    /**
     * @return mixed
     */
    public function getCleaners()
    {
        return Cleaner::get(['*', DB::raw('concat(street_number, ", ", street_name, ", ", city, " ", post_code) AS address'), DB::raw('concat(first_name, " ", last_name) AS name'), 'initial_password']);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getUsername($user_id = 0)
    {
        return User::where('id', '=', $user_id)->first(['username']);
    }

    /**
     * @param int $cleaner_id
     * @return mixed
     */
    public function getCleanerTaskDetails($cleaner_id = 0)
    {
        return DB::select(DB::raw("SELECT
  clients.name,
  schedules.start_time,
  schedules.end_time,
  schedules.`repeat`,
  schedules.repeat_mode
FROM cleaner_task
  INNER JOIN tasks ON cleaner_task.task_id = tasks.id
  INNER JOIN clients ON tasks.client_id = clients.id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
WHERE cleaner_id = $cleaner_id and clients.deleted_at is NULL"));
    }

    /**
     * @return mixed
     */
    public function getCleanersForReports()
    {
        return DB::select(DB::raw("SELECT
  max(cleaners.id)                                                                       AS id,
  concat(ifnull(max(cleaners.first_name), ''), ' ', ifnull(max(cleaners.last_name), '')) AS name
FROM cleaners
  INNER JOIN cleaner_task ON cleaners.id = cleaner_task.cleaner_id
GROUP BY cleaners.id
ORDER BY max(cleaners.first_name) ASC;"));
    }

    /**
     * @return mixed
     */
    public function getInspectorsForReports()
    {
        return DB::select(DB::raw("SELECT
  max(inspectors.id)                                               AS id,
  concat(ifnull(max(inspectors.first_name), ''), ' ', ifnull(max(inspectors.last_name), '')) AS name
FROM inspectors
  INNER JOIN inspector_task ON inspectors.id = inspector_task.inspector_id
GROUP BY inspectors.id
ORDER BY max(inspectors.first_name) ASC"));
    }


    /**
     * @return mixed
     */
    public function getInspectors()
    {
        return Inspector::get(['*', DB::raw('concat(street_number, ", ", street_name, ", ", city, " ", post_code) AS address'), DB::raw('concat(first_name, " ", last_name) AS name', 'initial_password')]);
    }

    /**
     * @param int $inspector_id
     * @return mixed
     */
    public function getInspectorTaskDetails($inspector_id = 0)
    {
        return DB::select(DB::raw("SELECT
          clients.name,
          schedules.start_time,
          schedules.end_time,
          inspector_task.start_date,
          inspector_task.end_date,
          schedules.`repeat`,
          schedules.repeat_mode,
               tasks.name as task_name
        FROM inspector_task
          INNER JOIN tasks ON inspector_task.task_id = tasks.id
          INNER JOIN clients ON tasks.client_id = clients.id
          INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
          INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
        WHERE inspector_id = $inspector_id and clients.deleted_at is NULL "));
    }

    /**
     * @param int $inspector_id
     * @return mixed
     */
    public function getInspectorTaskTimes($inspector_id = 0)
    {
        return DB::select(DB::raw("SELECT
            clients.name, 
            inspector_task.start_date,
            inspector_task.end_date, 
            tasks.name as task_name,
            tasks.type as task_type
        FROM inspector_task
          INNER JOIN tasks ON inspector_task.task_id = tasks.id
          INNER JOIN clients ON tasks.client_id = clients.id 
        WHERE inspector_id = $inspector_id and clients.deleted_at is NULL "));
    }

    /**
     * @return mixed
     */
    public function getCleanersLoginDetails()
    {
        return DB::table('cleaners')
            ->join('cleaner_schedules', 'cleaners.id', '=', 'cleaner_schedules.cleaner_id')
            ->join('tasks', 'cleaner_schedules.task_id', '=', 'tasks.id')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
            ->whereRaw(DB::raw('cleaners.deleted_at IS NULL'))
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->orderBy('cleaner_schedules.start_time', 'desc')
            ->get([
                'cleaners.id as id',
                'clients.id as client_id',
                'cleaners.first_name',
                'cleaners.last_name',
                'cleaners.telephone',
                'cleaners.pan_number',
                'cleaners.type',
                'cleaner_schedules.start_time AS login',
                'cleaner_schedules.end_time AS logout',
                'tasks.name AS task_name',
                'clients.name AS client_first_name',
                'schedules.start_time',
                'schedules.end_time',
                'schedules.repeat_mode',
                'schedules.repeat',
            ]);
    }

    /**
     * @param int $cleaner_id
     * @return mixed
     */
    public function getCleanerDetails($cleaner_id)
    {
        return DB::table('cleaners')
            ->join('cleaner_schedules', 'cleaners.id', '=', 'cleaner_schedules.cleaner_id')
            ->join('tasks', 'cleaner_schedules.task_id', '=', 'tasks.id')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
            ->whereRaw(DB::raw('cleaners.deleted_at IS NULL'))
            ->whereRaw(DB::raw('cleaners.id = '.$cleaner_id))
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->orderBy('cleaner_schedules.start_time', 'desc')
            ->get([
                'cleaners.id as id',
                'clients.id as client_id',
                'cleaners.first_name',
                'cleaners.last_name',
                'cleaners.telephone',
                'cleaners.pan_number',
                'cleaners.type',
                'cleaner_schedules.start_time AS login',
                'cleaner_schedules.end_time AS logout',
                'tasks.name AS task_name',
                'clients.name AS client_first_name',
                'schedules.start_time',
                'schedules.end_time',
                'schedules.repeat_mode',
                'schedules.repeat',
            ]);
    }

    /**
     * @param int $cleaner_id
     * @return mixed
     */
    public function getCleanerClients($cleaner_id)
    {
        return DB::table('cleaners')
            ->join('cleaner_schedules', 'cleaners.id', '=', 'cleaner_schedules.cleaner_id')
            ->join('tasks', 'cleaner_schedules.task_id', '=', 'tasks.id')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
            ->whereRaw(DB::raw('cleaners.deleted_at IS NULL'))
            ->whereRaw(DB::raw('cleaners.id = '.$cleaner_id))
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->groupBy('client_first_name')
            ->get([
                'clients.name AS client_first_name',
            ]);
    }

    /**
     * @param string $work_date
     * @return mixed
     */
    public function getCleanerTimes($work_date = '')
    {
        return DB::table('cleaner_times')
            ->join('clients', 'cleaner_times.client_id', '=', 'clients.id')
            ->join('cleaners', 'cleaners.id', '=', 'cleaner_times.cleaner_id')
            ->whereRaw(DB::raw('cleaners.deleted_at IS NULL'))
            ->whereRaw(DB::raw('cleaner_times.work_date = "'.$work_date.'"'))
            ->get([
                'cleaner_times.id as id',
                'clients.id as client_id',
                'cleaners.first_name',
                'cleaners.last_name',
                'clients.name AS client_first_name',
                'cleaner_times.work_days',
                'cleaner_times.work_date',
                'cleaner_times.time',
                'cleaner_times.mobile',
                'cleaner_times.telephone',
                'cleaner_times.number_of_people',
                'cleaner_times.time_in',
                'cleaner_times.time_out'
            ]);
    }

    /**
     * @return mixed
     */
    public function addNewCleanerTime($client = '', $cleaner = '', $sub_client = '', $work_days = '', $work_date = '', $time = '', $mobile = '', $telephone = '', $people = '', $sign_in = '', $sign_out = '')
    {
        return CleanerTimes::create([
            'client_id' => $client,
            'cleaner_id' => $cleaner,
            'client_sub_id' => $sub_client,
            'work_days' => $work_days,
            'work_date' => $work_date,
            'time' => $time,
            'mobile' => $mobile,
            'telephone' => $telephone,
            'number_of_people' => $people,
            'time_in' => $sign_in,
            'time_out' => $sign_out
        ]);
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $postal_code
     * @param string $telephone
     * @param string $mobile
     * @param string $start_date
     * @param bool $type
     * @param string $role
     * @param string $image
     * @return mixed
     */
    public function addNewCleaner($username = '', $password = '', $email = '', $first_name = '', $last_name = '', $street_number = '', $street_name = '', $city = '', $postal_code = '', $telephone = '', $mobile = '', $start_date = '', $type = true, $role = '', string $image)
    {
        $user = User::create([
            'name' => $username,
            'password' => bcrypt($password),
            'email' => $email,
            'role' => $role,
            'username' => $username,
        ]);

        return Cleaner::create([
            'user_id' => $user->id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'city' => $city,
            'post_code' => $postal_code,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'start_date' => $start_date,
            'type' => $type,
            'pan_number' => 'FBM 000' . $user->id,
            'initial_password' => $password,
            'image' => $image,
        ]);
    }

    /**
     * @param string $user_id
     * @param string $cleaner_id
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $postal_code
     * @param string $telephone
     * @param string $mobile
     * @param string $start_date
     * @return mixed
     */
    public function updateCleaner($user_id = '', $cleaner_id = '', $email = '', $first_name = '', $last_name = '', $street_number = '', $street_name = '', $city = '', $postal_code = '', $telephone = '', $mobile = '', $start_date = '')
    {
        $user = User::where('id', '=', $user_id)->update([
            'email' => $email,
        ]);

        return Cleaner::where('id', '=', $cleaner_id)->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'city' => $city,
            'post_code' => $postal_code,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'start_date' => $start_date,
        ]);
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
     * @param int $cleaner_id
     * @param string $password
     * @return mixed
     */
    public function updateCleanerInitialPassword($cleaner_id = 0, $password = '')
    {
        return Cleaner::where('id', '=', $cleaner_id)->update([
            'initial_password' => $password
        ]);
    }

    public function updateInspectorInitialPassword($inspector_id = 0, $password = '')
    {
        return Inspector::where('id', '=', $inspector_id)->update([
            'initial_password' => $password
        ]);
    }


    /**
     * @param $cleaner_id
     * @return mixed
     */
    public function getCleaner($cleaner_id)
    {
        return DB::table('cleaners')
            ->where('cleaners.id', '=', $cleaner_id)
            ->join('users', 'cleaners.user_id', '=', 'users.id')
            ->first([
                'cleaners.id AS cleaner_id',
                'user_id',
                'first_name',
                'last_name',
                'telephone',
                'mobile',
                'street_number',
                'street_name',
                'city',
                'post_code',
                'start_date',
                'email'
            ]);
    }

    /**
     * @param $inspector_id
     * @return mixed
     */
    public function getInspectorFromId($inspector_id)
    {
        return DB::table('inspectors')
            ->where('inspectors.id', '=', $inspector_id)
            ->join('users', 'inspectors.user_id', '=', 'users.id')
            ->first([
                'inspectors.id AS inspector_id',
                'user_id',
                'first_name',
                'last_name',
                'telephone',
                'mobile',
                'street_number',
                'street_name',
                'city',
                'post_code',
                'initial_password',
                'agreement_start',
                'email',
                'image',
                'level'
            ]);
    }



    /**
     * @return mixed
     */
//    public function getInspectors()
//    {
//        return DB::table('inspectors')
//            ->join('inspector_task', 'inspectors.id', '=', 'inspector_task.inspector_id')
//            ->join('tasks', 'inspector_task.task_id', '=', 'tasks.id')
//            ->join('clients', 'tasks.client_id', '=', 'clients.id')
//            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
//            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
//            ->get([
//                'inspectors.id AS inspector_id',
//                'inspectors.first_name',
//                'inspectors.last_name',
//                'inspectors.telephone',
//                'inspectors.street_number',
//                'inspectors.street_name',
//                'inspectors.city',
//                'inspectors.post_code',
//                'inspectors.pan_number',
//                'tasks.name    AS task_name',
//                'clients.name  AS client_first_name',
//                'clients.last_name  AS client_last_name',
//                'schedules.repeat',
//                'schedules.start_time',
//                'schedules.end_time',
//                'schedules.repeat_mode',
//            ]);
//    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $postal_code
     * @param string $telephone
     * @param string $mobile
     * @param string $start_date
     * @param string $level
     * @param string $image
     * @return mixed
     */
    public function addNewInspector($username = '', $password = '', $email = '', $first_name = '', $last_name = '', $street_number = '', $street_name = '', $city = '', $postal_code = '', $telephone = '', $mobile = '', $start_date = '', $level = 'INSPECTOR_1', string $image)
    {
        $user = User::create([
            'name' => $username,
            'password' => bcrypt($password),
            'email' => $email,
            'role' => $level,
            'username' => $username,
        ]);

        return Inspector::create([
            'user_id' => $user->id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'city' => $city,
            'post_code' => $postal_code,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'agreement_start' => $start_date,
            'pan_number' => 'FBM 000' . $user->id,
            'initial_password' => $password,
            'level' => $level,
            'image' => $image,
        ]);
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return User::where('id', '<>', 1)
            ->get();
    }

    /**
     * @param int $user_id
     * @param string $status
     * @return mixed
     */
    public function updateUserStatus($user_id = 0, $status = '')
    {
        return User::where('id', '=', $user_id)->update([
            'status' => $status
        ]);
    }

    /**
     * @param string $user_id
     * @param string $inspector_id
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $postal_code
     * @param string $telephone
     * @param string $mobile
     * @param string $start_date
     * @param string $level
     * @return mixed
     */
    public function updateInspector($user_id = '', $inspector_id = '', $email = '', $first_name = '', $last_name = '', $street_number = '', $street_name = '', $city = '', $postal_code = '', $telephone = '', $mobile = '', $start_date = '', $level = 'INSPECTOR_1')
    {
        $user = User::where('id', '=', $user_id)->update([
            'email' => $email,
        ]);

        return Inspector::where('id', '=', $inspector_id)->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'city' => $city,
            'post_code' => $postal_code,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'agreement_start' => $start_date,
            'level' => $level,
        ]);
    }

    /**
     * @param string $first_name
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $post_code
     * @param string $continuous
     * @param string $supply_required
     * @param string $termination_date
     * @param string $start_date
     * @param string $lock_code
     * @param string $alarm_code
     * @param string $payment_date
     * @param int $category
     * @param string $contract
     * @return mixed
     */
    public function addNewClient($first_name = '', $street_number = '', $street_name = '', $city = '', $post_code = '', $continuous = '', $supply_required = '', $termination_date = '', $start_date = '', $lock_code = '', $alarm_code = '', $payment_date = '', $category = 0, $contract = '')
    {
        return Client::create([
            'name' => $first_name,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'city' => $city,
            'post_code' => $post_code,
            'continuous' => $continuous,
            'supply_required' => $supply_required,
            'termination_date' => $termination_date,
            'start_date' => $start_date,
            'lock_code' => $lock_code,
            'alarm_code' => $alarm_code,
            'payment' => $payment_date,
            'category_id' => $category,
            'contract' => $contract,
        ]);
    }

    /**
     * @param string $client_id
     * @param string $first_name
     * @param string $street_number
     * @param string $street_name
     * @param string $city
     * @param string $post_code
     * @param string $supply_required
     * @param string $termination_date
     * @param string $start_date
     * @param string $lock_code
     * @param string $alarm_code
     * @param string $payment_date
     * @param bool $continuous
     * @param int $category
     * @return mixed
     */
    public function updateClient($client_id = '', $first_name = '', $street_number = '', $street_name = '', $city = '', $post_code = '', $supply_required = '', $termination_date = '', $start_date = '', $lock_code = '', $alarm_code = '', $payment_date = '', $continuous = false, $category = 0)
    {
        return Client::where('id', '=', $client_id)
            ->update([
                'name' => $first_name,
                'street_number' => $street_number,
                'street_name' => $street_name,
                'city' => $city,
                'post_code' => $post_code,
                'supply_required' => $supply_required,
                'termination_date' => $termination_date,
                'start_date' => $start_date,
                'lock_code' => $lock_code,
                'alarm_code' => $alarm_code,
                'payment' => $payment_date,
                'continuous' => $continuous,
                'category_id' => $category,
            ]);
    }

    /**
     * @param int $client_id
     * @param string $first_name
     * @param string $email
     * @param string $telephone
     * @param string $post_code
     * @return mixed
     */
    public function addNewOperationalContact($client_id = 0, $first_name = '', $email = '', $telephone = '', $post_code = '')
    {
        return OperationalContact::create([
            'client_id' => $client_id,
            'first_name' => $first_name,
            'email' => $email,
            'telephone' => $telephone,
            'post_code' => $post_code,
        ]);
    }

    /**
     * @param int $client_id
     * @param string $first_name
     * @param string $email
     * @param string $telephone
     * @param string $post_code
     * @return mixed
     */
    public function addNewAccountingContact($client_id = 0, $first_name = '', $email = '', $telephone = '', $post_code = '')
    {
        return AccountingContact::create([
            'client_id' => $client_id,
            'first_name' => $first_name,
            'email' => $email,
            'telephone' => $telephone,
            'post_code' => $post_code,
        ]);
    }

    /**
     * @param int $id
     * @param string $first_name
     * @param string $email
     * @param string $telephone
     * @return mixed
     */
    public function updateOperationalContact($id = 0, $first_name = '', $email = '', $telephone = '')
    {
        return OperationalContact::where('id', '=', $id)
            ->update([
                'first_name' => $first_name,
                'email' => $email,
                'telephone' => $telephone
            ]);
    }

    /**
     * @param int $id
     * @param string $first_name
     * @param string $email
     * @param string $telephone
     * @return mixed
     */
    public function updateAccountingContact($id = 0, $first_name = '', $email = '', $telephone = '')
    {
        return AccountingContact::where('id', '=', $id)
            ->update([
                'first_name' => $first_name,
                'email' => $email,
                'telephone' => $telephone
            ]);
    }

    /**
     * @return mixed
     */
    public function getClients()
    {
        return Client::get(['*', DB::raw('concat(street_number, ", ", street_name, ", ", post_code, " ", city) AS address')]);
    }

    /**
     * @param string $from_date
     * @param string $to_date
     * @param string $conditions
     * @return mixed
     */
    public function getClientsForClientsReports($from_date = '', $to_date = '', $conditions = '')
    {
        return DB::select(DB::raw("select clients.*,
       concat(clients.street_number, ', ', clients.street_name, ', ', clients.post_code, ' ', clients.city) as address,
       categories.name                                                                                      as category,
       concat(cleaners.first_name, ' ', cleaners.last_name)                                                 as cleaner,
       schedules.*,
       clients.id                                                                                           as client_id,
       cleaner_id                                                                                           as cleaner_id,
       tasks.id                                                                                             as task_id
from clients
       left join categories on clients.category_id = categories.id
       inner join tasks on clients.id = tasks.client_id
       inner join cleaner_task on tasks.id = cleaner_task.task_id
       inner join schedule_task on tasks.id = schedule_task.task_id
       inner join schedules on schedule_task.schedule_id = schedules.id
       inner join cleaners on cleaner_task.cleaner_id = cleaners.id
       inner join inspector_task on tasks.id = inspector_task.task_id
       inner join inspectors on inspector_task.inspector_id = inspectors.id
WHERE date(schedules.start_time) >= '$from_date'
  AND date(schedules.start_time) <= '$to_date' $conditions
;"));
    }

    /**
     * @return mixed
     */
    public function getTaskClients()
    {
        return DB::select(DB::raw("SELECT
  max(clients.id)   AS id,
  max(clients.name) AS name
FROM tasks
  INNER JOIN clients ON tasks.client_id = clients.id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
WHERE clients.deleted_at IS NULL
GROUP BY clients.id;"));
    }

    /**
     * @return mixed
     */
    public function getClientsForStoreReport()
    {
        return DB::select(DB::raw("SELECT
  max(clients.name)                                                                        AS name,
  max(clients.id)                                                                          AS id,
  concat(max(street_number), ', ', max(street_name), ', ', max(post_code), ' ', max(city)) AS address
FROM clients
  INNER JOIN client_product ON clients.id = client_product.client_id
GROUP BY clients.id"));
    }

    /**
     * @return mixed
     */
    public function getClientsForReports()
    {
        return DB::select(DB::raw("SELECT
  max(clients.id)   AS id,
  max(clients.name) AS name
FROM clients
  INNER JOIN tasks ON clients.id = tasks.client_id
GROUP BY clients.id
ORDER BY max(clients.name) ASC"));
    }

    /**
     * @param string $from_time
     * @param string $to_time
     * @return mixed
     */
    public function getClientCleanerDetails($from_time = '', $to_time = '')
    {
        return DB::select(DB::raw("SELECT
  clients.id                     AS client_id,
  concat(clients.name, ', ', clients.street_number, ', ', clients.street_name, ', ', clients.city, ', ',
         clients.post_code)      AS client,
  cleaners.id                    AS cleaners_id,
  concat(cleaners.first_name, ' ', cleaners.last_name, ', ', cleaners.street_number, ', ', cleaners.street_name, ', ',
         cleaners.city, ', ',
         cleaners.post_code)     AS cleaner,
  cleaner_schedules.start_time,
  cleaner_schedules.end_time,
  timediff(end_time, start_time) AS working_hours
FROM clients
  INNER JOIN tasks ON clients.id = tasks.client_id
  INNER JOIN cleaner_schedules ON tasks.id = cleaner_schedules.task_id
  INNER JOIN cleaners ON cleaner_schedules.cleaner_id = cleaners.id
WHERE start_time >= '$from_time' AND start_time <= '$to_time'
ORDER BY start_time DESC"));
    }

    /**
     * @param string $from_time
     * @param string $to_time
     * @param string $conditions
     * @return mixed
     */
    public function getCleanerClientDetails($from_time = '', $to_time = '', $conditions = '')
    {
        return DB::select(DB::raw("SELECT
  clients.id                                                         AS client_id,
  concat(clients.name, ', ', clients.street_number, ', ', clients.street_name, ', ', clients.city, ', ',
         clients.post_code)                                          AS client,
  cleaners.id                                                        AS cleaners_id,
  concat(cleaners.first_name, ' ', cleaners.last_name, ', ', cleaners.street_number, ', ', cleaners.street_name, ', ', cleaners.city, ', ',
         cleaners.post_code)               AS cleaner,
  cleaners.deleted_at                                                AS deleted,
  cleaners.termination                                               AS reason,
  cleaner_schedules.id                                               AS cleaner_schedule_id,
  tasks.id                                                           AS task_id,
  cleaner_schedules.start_time                                       AS cleaner_start_time,
  cleaner_schedules.end_time                                         AS cleaner_end_time,
  timediff(cleaner_schedules.end_time, cleaner_schedules.start_time) AS working_hours,
  schedules.start_time                                               AS schedule_start,
  schedules.end_time                                                 AS schedule_end
FROM clients
  INNER JOIN tasks ON clients.id = tasks.client_id
  INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
  INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
  LEFT JOIN cleaner_schedules ON tasks.id = cleaner_schedules.task_id
  INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
  INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
WHERE schedules.start_time >= '$from_time' AND schedules.start_time <= '$to_time' $conditions
ORDER BY schedules.start_time DESC"));
    }

    /**
     * @param string $from_time
     * @param string $to_time
     * @param string $conditions
     * @return mixed
     */
    public function getClientTasksDetails($from_time = '', $to_time = '', $conditions = '')
    {
        return DB::select(DB::raw("SELECT max(tasks.id)                     AS task_id,
       max(tasks.name)                   AS task_name,
       max(clients.name)                 AS client_name,
       max(cleaners.first_name)          AS cleaner_first_name,
       max(cleaners.last_name)           AS cleaner_last_name,
       max(cleaners.pan_number)          AS cleaner_number,
       max(inspectors.first_name)        AS inspector_first_name,
       max(inspectors.last_name)         AS inspector_last_name,
       max(inspectors.pan_number)        AS inspector_number,
       max(cleaner_schedules.start_time) AS start_time,
       max(cleaner_schedules.end_time)   AS end_time,
       max(schedules.`repeat`)           AS task_repeat,
       max(schedules.repeat_mode)        AS repeat_mode
FROM tasks
         INNER JOIN clients ON tasks.client_id = clients.id
         INNER JOIN cleaner_task ON tasks.id = cleaner_task.task_id
         INNER JOIN cleaners ON cleaner_task.cleaner_id = cleaners.id
         INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
         INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
         INNER JOIN schedule_task ON tasks.id = schedule_task.task_id
         INNER JOIN schedules ON schedule_task.schedule_id = schedules.id
         LEFT JOIN cleaner_schedules on tasks.id = cleaner_schedules.task_id
WHERE ((cleaner_schedules.start_time >= '$from_time' AND cleaner_schedules.start_time <= '$to_time') or
       (schedules.start_time >= '$from_time' AND schedules.start_time <= '$to_time')) $conditions
GROUP BY tasks.id
"));
    }

    /**
     * @param int $task_id
     * @return mixed
     */
    public function getClientSubTasks($task_id = 0)
    {
        return TaskItem::where('task_id', '=', $task_id)->get();
    }

    /**
     * @param string $from_time
     * @param string $to_time
     * @param string $conditions
     * @return mixed
     */
    public function getInspectorClientDetails($from_time = '', $to_time = '', $conditions = '')
    {
        return DB::select(DB::raw("SELECT clients.id                     AS client_id,
       concat(clients.name, ', ', clients.street_number, ', ', clients.street_name, ', ', clients.city, ', ',
              clients.post_code)      AS client,
       inspectors.id                  AS inspectors_id,
       concat(inspectors.first_name, ' ', inspectors.last_name, ', ', inspectors.street_number, ', ',
              inspectors.street_name, ', ',
              inspectors.city, ', ',
              inspectors.post_code)   AS inspector,
       inspector_schedules.start_time,
       inspectors.deleted_at          AS deleted,
       inspectors.termination         AS reason,
       inspectors.level               as level,
       tasks.id                       as task_id,
         inspector_schedules.start_time                                       AS inspector_start_time,
  inspector_schedules.end_time                                         AS inspector_end_time,
       timediff(inspector_schedules.end_time, inspector_schedules.start_time) AS working_hours
FROM clients
       INNER JOIN tasks ON clients.id = tasks.client_id
       INNER JOIN inspector_task ON tasks.id = inspector_task.task_id
       INNER JOIN inspectors ON inspector_task.inspector_id = inspectors.id
       LEFT JOIN inspector_schedules ON tasks.id = inspector_schedules.task_id
WHERE start_time >= '$from_time' AND start_time <= '$to_time' $conditions
ORDER BY start_time DESC"));
    }

    /**
     * @return mixed
     */
    public function getClientsForSupply()
    {
        return Client::where('supply_required', '=', true)->get(['*', DB::raw('concat(street_number, ", ", street_name, ", ", post_code, " ", city) AS address')]);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getAdminByUser($user_id = 0)
    {
        return Admin::where('user_id', '=', $user_id)->first();
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getAdminPermissionsByUser($user_id = 0)
    {
        return DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->leftjoin('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->whereRaw(DB::raw('permissions.deleted_at IS NULL'))
            ->whereRaw(DB::raw('users.id = '.$user_id))
            ->whereRaw(DB::raw('roles.deleted_at IS NULL'))
            ->get([
                'permissions.name'
            ]);
    }

    /**
     * @param int $administrator_id
     * @return mixed
     */
    public function getAdministrator($administrator_id = 0)
    {
        return Admin::where('id', '=', $administrator_id)->first();
    }

    /**
     * @param int $inspector_id
     * @return mixed
     */
    public function getInspector($inspector_id = 0)
    {
        return Inspector::where('id', '=', $inspector_id)->first();
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getClient($client_id = 0)
    {
        return Client::where('id', '=', $client_id)->first();
    }

    /**
     * @param int $admin_level
     * @param int $level
     * @param int $parent
     * @return mixed
     */
    public function getMenus($admin_level = 0, $level = 0, $parent = 0)
    {
        return Menu::where('admin_level', '>=', $admin_level)
            ->where('level', '=', $level)
            ->where('parent', '=', $parent)
            ->get();
    }

    /**
     * @param string $query
     * @param int $admin_level
     * @return mixed
     */
    public function searchMenus($query = '', $admin_level = 0)
    {
        return DB::select(DB::raw("SELECT *
FROM menus
WHERE url LIKE '%$query%' AND admin_level >= '$admin_level'"));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getOperationalContacts($client_id = 0)
    {
        return OperationalContact::where('client_id', '=', $client_id)
            ->get();
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getAccountingContacts($client_id = 0)
    {
        return AccountingContact::where('client_id', '=', $client_id)
            ->get();
    }

    /**
     * @param string $from_date
     * @param string $to_date
     * @return mixed
     */
    public function getClientReminder($from_date = '', $to_date = '')
    {
        return DB::select(DB::raw("SELECT *
FROM clients
WHERE continuous IS FALSE AND start_date > '" . $from_date . "' AND start_date < '" . $to_date . "' AND clients.deleted_at IS NULL"));
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getAdministratorByUser($user_id = 0)
    {
        return Admin::where('user_id', '=', $user_id)->first();
    }

    /**
     * @return mixed
     */
    public function getCleanersForComplaints()
    {
        return DB::select(DB::raw("SELECT
  max(cleaners.id)         AS id,
  max(cleaners.first_name) AS first_name,
max(cleaners.last_name)  AS last_name
FROM cleaners
INNER JOIN complaints ON cleaners.id = complaints.cleaner_id
GROUP BY cleaners.id;"));
    }

    /**
     * @return mixed
     */
    public function getClientsForComplaints()
    {
        return DB::select(DB::raw("SELECT
  max(clients.id)   AS id,
  max(clients.name) AS name
FROM clients
  INNER JOIN tasks ON clients.id = tasks.client_id
#  INNER JOIN complaints ON tasks.id = complaints.task_id
GROUP BY clients.id;"));
    }

    public function getClientsForComplaintsView()
    {
        return DB::select(DB::raw("SELECT
  max(clients.id)   AS id,
  max(clients.name) AS name
FROM clients
  INNER JOIN tasks ON clients.id = tasks.client_id
  INNER JOIN complaints ON tasks.id = complaints.task_id
GROUP BY clients.id;"));
    }


    /**
     * @return mixed
     */
    public function getInspectorsForComplaints()
    {
        return DB::select(DB::raw("SELECT
  max(inspectors.id)         AS id,
  max(inspectors.first_name) AS first_name,
  max(inspectors.last_name)  AS last_name
FROM inspectors
  INNER JOIN complaints ON inspectors.id = complaints.inspector_id
GROUP BY inspectors.id;"));
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function deleteAdministrator($user_id = 0)
    {
//        try {
        return Admin::where('user_id', '=', $user_id)->delete();
//        } catch (Exception $exception) {
//            return 'key';
//        }
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function deleteCleaner($user_id = 0)
    {
//        try {
        return Cleaner::where('user_id', '=', $user_id)->delete();
//        } catch (Exception $exception) {
//            return 'key';
//        }
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function deleteInspector($user_id = 0)
    {
//        try {
        return Inspector::where('user_id', '=', $user_id)->delete();
//        } catch (Exception $exception) {
//            return 'key';
//        }
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function deleteUser($user_id = 0)
    {
//        try {
        return User::where('id', '=', $user_id)->delete();
//        } catch (Exception $exception) {
//            return 'key';
//        }
    }

    /**
     * @param int $user_id
     * @param string $termination
     * @return mixed
     */
    public function updateCleanerTermination($user_id = 0, $termination = '')
    {
        return Cleaner::where('user_id', '=', $user_id)->update([
            'termination' => $termination
        ]);
    }

    /**
     * @param int $user_id
     * @param string $termination
     * @return mixed
     */
    public function updateInspectorTermination($user_id = 0, $termination = '')
    {
        return Inspector::where('user_id', '=', $user_id)->update([
            'termination' => $termination
        ]);
    }

    /**
     * @param int $user_id
     * @param string $termination
     * @return mixed
     */
    public function updateAdministratorTermination($user_id = 0, $termination = '')
    {
        return Admin::where('user_id', '=', $user_id)->update([
            'termination' => $termination
        ]);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getUser(int $user_id)
    {
        return User::where('id', '=', $user_id)->first();
    }

    /**
     * @param int $user_id
     * @param string $level
     * @return mixed
     */
    public function updateInspectorType(int $user_id, string $level)
    {
        return User::where('id', '=', $user_id)->update(['role' => $level]);
    }

    /**
     * @param int $cleaner_id
     * @param string $upload
     * @return mixed
     */
    public function updateCleanerImage(int $cleaner_id, string $upload)
    {
        return Cleaner::whereId($cleaner_id)->update([
            'image' => $upload
        ]);
    }

    /**
     * @param int $inspector_id
     * @param string $upload
     * @return mixed
     */
    public function updateInspectorImage(int $inspector_id, string $upload)
    {
        return Inspector::whereId($inspector_id)->update([
            'image' => $upload
        ]);
    }

    /**
     * @return mixed
     */
    public function getInspectorsLoginDetails()
    {
        return DB::table('inspectors')
            ->join('inspector_schedules', 'inspectors.id', '=', 'inspector_schedules.inspector_id')
            ->join('tasks', 'inspector_schedules.task_id', '=', 'tasks.id')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
            ->join('schedule_task', 'tasks.id', '=', 'schedule_task.task_id')
            ->join('schedules', 'schedule_task.schedule_id', '=', 'schedules.id')
            ->whereRaw(DB::raw('inspectors.deleted_at IS NULL'))
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->orderBy('inspector_schedules.start_time', 'desc')
            ->get([
                'inspectors.id as id',
                'clients.id as client_id',
                'inspectors.first_name',
                'inspectors.last_name',
                'inspectors.telephone',
                'inspectors.pan_number',
                'inspector_schedules.start_time AS login',
                'inspector_schedules.end_time AS logout',
                'tasks.name AS task_name',
                'clients.name AS client_first_name',
                'schedules.start_time',
                'schedules.end_time',
                'schedules.repeat_mode',
                'schedules.repeat',
            ]);
    }

    /**
     * @param $name
     * @param $address
     * @return mixed
     */
    public function addNewClientForProspect($name, $address)
    {
        return Client::create([
            'name' => $name,
            'street_number' => $address
        ]);
    }

    /**
     * @param int $scheduleId
     * @return mixed
     */
    public function getCleanerFromSchedule(int $scheduleId)
    {
        return DB::select(DB::raw("select concat(cleaners.first_name, ' ', cleaners.last_name) as cleaner
from cleaners
         inner join cleaner_schedules on cleaners.id = cleaner_schedules.cleaner_id
where cleaner_schedules.id = $scheduleId;"));
    }
}