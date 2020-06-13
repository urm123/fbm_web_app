<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/9/2018
 * Time: 2:14 PM
 */

namespace App\Repositories;

use App\ClientFollowup;
use App\ClientFollowupComment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientFollowupRepository
 * @package App\Repositories
 */
class ClientFollowupRepository
{
    public function getClientFollowups($start_time = '', $end_time = '')
    {
        return DB::table('client_followups')
            ->join('clients', 'client_followups.client_id', '=', 'clients.id')
            ->leftJoin('tasks', 'client_followups.task_id', '=', 'tasks.id')
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->where('date', '>', $start_time)
            ->where('date', '<', $end_time)
            ->get([
                'client_followups.*',
                'clients.name AS client_name',
                'clients.id AS client_id',
                'tasks.name as task_name',
                'tasks.id as task_id',
                'client_followups.id as client_followup_id'
            ]);
    }

    /**
     * @param int $client_id
     * @param int $admin_id
     * @param string $type
     * @param string $comment
     * @param string $date
     * @param int $task_id
     * @return mixed
     */
    public function createClientFollowup($client_id = 0, $admin_id = 0, $type = '', $comment = '', $date = '', $task_id = 0)
    {
        return ClientFollowup::create([
            'client_id' => $client_id,
            'admin_id' => $admin_id,
            'type' => $type,
            'comment' => $comment,
            'date' => $date,
            'task_id' => $task_id,
            'status' => 'OPEN'
        ]);
    }

    /**
     * @param int $client_followup_id
     * @return mixed
     */
    public function getClientFollowupComments($client_followup_id = 0)
    {
        return DB::table('client_followup_comments')
            ->join('admins', 'client_followup_comments.admin_id', '=', 'admins.id')
            ->where('client_followup_id', '=', $client_followup_id)
            ->get();
    }

    /**
     * @param int $client_followup_id
     * @param int $admin_id
     * @param string $date
     * @param string $upload
     * @param string $comment
     * @param string $description
     * @return mixed
     */
    public function createClientFollowupComment($client_followup_id = 0, $admin_id = 0, $date = '', $upload = '', $comment = '', $description = '')
    {
        return ClientFollowupComment::create([
            'client_followup_id' => $client_followup_id,
            'admin_id' => $admin_id,
            'date' => $date,
            'upload' => $upload,
            'comment' => $comment,
            'description' => $description,
        ]);
    }

    /**
     * @param int $client_followup_id
     * @return mixed
     */
    public function updateClientFollowupTimeStamp($client_followup_id = 0)
    {
        $client_followup = ClientFollowup::where('id', '=', $client_followup_id)->first();
        return $client_followup->touch();
    }

    /**
     * @param int $client_followup_id
     * @return mixed
     */
    public function endClientFollowup($client_followup_id = 0)
    {
        return ClientFollowup::where('id', '=', $client_followup_id)
            ->update([
                'status' => 'ENDED',
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
    }
}