<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/23/2017
 * Time: 2:06 PM
 */

namespace App\Repositories;


use App\Complaint;
use App\ComplaintMedia;
use App\Feedback;
use App\Inspector;
use App\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class RestFeedbackRepository
 * @package App\Repositories
 */
class RestFeedbackRepository
{
    /**
     * @return mixed
     */
    public function getFeedbackData()
    {
        return DB::table('clients')
//            ->join('client_task', 'clients.id', '=', 'client_task.client_id')
            ->join('tasks', 'clients.id', '=', 'tasks.client_id')
            ->join('cleaner_task', 'tasks.id', '=', 'cleaner_task.task_id')
            ->join('cleaners', 'cleaner_task.cleaner_id', '=', 'cleaners.id')
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->get([
                'clients.id          AS client_id',
                'clients.name        AS client_first_name',
                'cleaners.id         AS cleaner_id',
                'cleaners.first_name AS cleaner_first_name',
                'cleaners.last_name  AS cleaner_last_name',
            ]);
    }

    /**
     * @param int $cleaner_id
     * @param int $task_id
     * @param int $user_id
     * @param int $feedback
     * @param int $rating
     * @param string $date
     * @return mixed
     */
    public function saveFeedback($cleaner_id = 0, $task_id = 0, $user_id = 0, $feedback = 0, $rating = 0, $date = '')
    {
        $inspector = Inspector::where('user_id', '=', $user_id)->first();
        return Feedback::create([
            'cleaner_id' => $cleaner_id,
            'task_id' => $task_id,
            'inspector_id' => $inspector->id,
            'feedback' => $feedback,
            'rating' => $rating,
            'date' => $date,
        ]);
    }

    public function getTicketData()
    {
        return DB::table('clients')
//            ->join('client_task', 'clients.id', '=', 'client_task.client_id')
            ->join('tasks', 'clients.id', '=', 'tasks.client_id')
            ->join('cleaner_task', 'tasks.id', '=', 'cleaner_task.task_id')
            ->join('cleaners', 'cleaner_task.cleaner_id', '=', 'cleaners.id')
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->get([
                'clients.id          AS client_id',
                'clients.name        AS client_first_name',
                'cleaners.id         AS cleaner_id',
                'cleaners.first_name AS cleaner_first_name',
                'cleaners.last_name  AS cleaner_last_name',
            ]);
    }

    /**
     * @param int $cleaner_id
     * @param int $task_id
     * @param int $user_id
     * @param string $ticket
     * @param string $date
     * @param string $complaint
     * @return mixed
     */
    public function saveTicket($cleaner_id = 0, $task_id = 0, $user_id = 0, $ticket = '', $date = '', $complaint = '')
    {
        $inspector = Inspector::where('user_id', '=', $user_id)->first();
        return Complaint::create([
            'cleaner_id' => $cleaner_id,
            'task_id' => $task_id,
            'inspector_id' => $inspector->id,
            'ticket' => $ticket,
            'date' => $date,
            'complaint' => $complaint,
        ]);
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
     * @param int $complaint_id
     * @param string $type
     * @return mixed
     */
    public function createComplaintImage($image_id = 0, $complaint_id = 0, $type = 'image')
    {
        return ComplaintMedia::create([
            'media_id' => $image_id,
            'complaint_id' => $complaint_id,
            'type' => $type,
        ]);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getComplaintByName(string $name)
    {
        return Complaint::where('ticket', '=', $name)->first();
    }

    /**
     * @param int $complaint_id
     * @param string $type
     * @return mixed
     */
    public function getComplaintMedia(int $complaint_id, string $type = 'image')
    {
        return DB::select(DB::raw("select media.*
from media
       inner join complaint_media on media.id = complaint_media.media_id
where complaint_id = $complaint_id
  and type like '$type'"));
    }
}