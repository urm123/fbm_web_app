<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/6/2018
 * Time: 5:30 PM
 */

namespace App\Repositories;


use App\ChecklistItemFeedback;
use App\Complaint;
use App\ComplaintFollowup;
use App\ComplaintMedia;
use App\Media;
use App\Task;
use App\TaskItem;
use Illuminate\Support\Facades\DB;

/**
 * Class FeedbackRepository
 * @package App\Repositories
 */
class FeedbackRepository
{
    /**
     * @return mixed
     */
    public function getComplaints()
    {
        return DB::table('complaints')
            ->join('tasks', 'complaints.task_id', '=', 'tasks.id')
            ->join('clients', 'tasks.client_id', '=', 'clients.id')
            ->join('inspectors', 'complaints.inspector_id', '=', 'inspectors.id')
            ->join('cleaners', 'complaints.cleaner_id', '=', 'cleaners.id')
            ->whereRaw(DB::raw('clients.deleted_at IS NULL'))
            ->orderBy('resolved', 'asc')
            ->orderBy('complaints.created_at', 'desc')
//            ->where('resolved', 'is', 'false')
            ->get([
                'complaints.id',
                'complaints.date',
                'clients.name    AS client_first_name',
                'complaints.complaint',
                'complaints.created_at',
                'complaints.updated_at',
                'cleaners.first_name   AS cleaners_first_name',
                'cleaners.last_name    AS cleaners_last_name',
                'inspectors.first_name AS inspectors_first_name',
                'inspectors.last_name  AS inspectors_last_name',
                'inspectors.id         AS inspector_id',
                'cleaners.id           AS cleaner_id',
                'clients.id            AS client_id',
                'complaints.type',
                'complaints.resolved',
                'complaints.ticket',
            ]);
    }

    /**
     * @param int $complaint_id
     * @return mixed
     */
    public function getComplaintFollowups($complaint_id = 0)
    {
        return ComplaintFollowup::where('complaint_id', '=', $complaint_id)->get();
    }

    /**
     * @param int $complaint_id
     * @param int $admin_id
     * @param string $comment
     * @param string $description
     * @param string $upload
     * @param string $date
     * @return mixed
     */
    public function createComplaintFollowup($complaint_id = 0, $admin_id = 0, $comment = '', $description = '', $upload = '', $date = '')
    {
        return ComplaintFollowup::create([
            'complaint_id' => $complaint_id,
            'admin_id' => $admin_id,
            'comment' => $comment,
            'description' => $description,
            'upload' => $upload,
            'date' => $date,
        ]);
    }

    public function updateComplaintTimeStamp($complaint_id = 0)
    {
        $complaint = Complaint::where('id', '=', $complaint_id)->first();
        return $complaint->touch();
    }

    /**
     * @param string $ticket
     * @param int $cleaner_id
     * @param int $task_id
     * @param int $inspector_id
     * @param string $date
     * @param string $complaint
     * @param string $upload
     * @return mixed
     */
    public function createComplaint($ticket = '', $cleaner_id = 0, $task_id = 0, $inspector_id = 0, $date = '', $complaint = '', $upload = '')
    {
        return Complaint::create([
            'ticket' => $ticket,
            'cleaner_id' => $cleaner_id,
            'task_id' => $task_id,
            'inspector_id' => $inspector_id,
            'date' => $date,
            'complaint' => $complaint,
            'upload' => $upload,
        ]);
    }

    /**
     * @param int $complaint_id
     * @return mixed
     */
    public function endComplaintFollowup($complaint_id = 0)
    {
        return Complaint::where('id', '=', $complaint_id)
            ->update([
                'resolved' => true
            ]);
    }

    public function getComplaintsForReports($from_date = '', $to_date = '', $conditions = '')
    {
        return DB::select(DB::raw("SELECT
  complaints.complaint,
  complaints.ticket,
  concat(clients.name, ', ', clients.street_number, ', ', clients.street_name, ', ', clients.city, ', ',
         clients.post_code)    AS client,
  concat(cleaners.first_name, ' ', cleaners.last_name, ', ', cleaners.street_number, ', ', cleaners.street_name, ', ',
         cleaners.city, ', ',
         cleaners.post_code)   AS cleaner,
  concat(inspectors.first_name, ' ', inspectors.last_name, ', ', inspectors.street_number, ', ', inspectors.street_name,
         ', ',
         inspectors.city, ', ',
         inspectors.post_code) AS inspector,
  resolved,
  complaints.date,
  complaints.upload,
  complaints.id
FROM complaints
  INNER JOIN cleaners ON complaints.cleaner_id = cleaners.id
  INNER JOIN inspectors ON complaints.inspector_id = inspectors.id
  INNER JOIN tasks ON complaints.task_id = tasks.id
  INNER JOIN clients ON tasks.client_id = clients.id
WHERE complaints.date >= '$from_date' AND complaints.date <= '$to_date' $conditions"));
    }

    /**
     * @param string $from_date
     * @param string $to_date
     * @param string $conditions
     * @return mixed
     */
    public function getClientFollowupsForReport($from_date = '', $to_date = '', $conditions = '')
    {
        return DB::select(DB::raw("SELECT client_followups.comment,
       concat(clients.name, ', ', clients.street_number, ', ', clients.street_name, ', ', clients.city, ', ',
              clients.post_code)                                        AS client,
       concat(followup_admin.first_name, ' ', followup_admin.last_name) AS followup_admin,
       concat(comment_admin.first_name, ' ', comment_admin.last_name)   AS comment_admin,
       client_followups.date,
       client_followups.id,
       client_followups.type,
       client_followups.status,
       client_followup_comments.comment                                 as feedback_comment,
       client_followup_comments.date                                    as comment_date
FROM client_followups
       INNER JOIN admins followup_admin ON client_followups.admin_id = followup_admin.id
       INNER JOIN clients ON client_followups.client_id = clients.id
       inner join client_followup_comments on client_followups.id = client_followup_comments.client_followup_id
       INNER JOIN admins comment_admin ON client_followup_comments.admin_id = comment_admin.id
WHERE client_followup_comments.date >= '$from_date' AND client_followup_comments.date <= '$to_date' $conditions"));
    }

    /**
     * @param int $complaint_id
     * @return mixed
     */
    public function getComplaintImages($complaint_id = 0)
    {
        return DB::select(DB::raw("SELECT *
FROM media
  INNER JOIN complaint_media ON media.id = complaint_media.media_id
WHERE complaint_id = $complaint_id  and type like 'image'"));
    }

    /**
     * @param int $complaint_id
     * @return mixed
     */
    public function getComplaintAudio($complaint_id = 0)
    {
        return DB::select(DB::raw("SELECT *
FROM media
  INNER JOIN complaint_media ON media.id = complaint_media.media_id
WHERE complaint_id = $complaint_id  and type like 'audio'"));
    }

    /**
     * @return mixed
     */
    public function getTasksFromComplaints()
    {
        return DB::select(DB::raw("SELECT *
FROM tasks
WHERE name LIKE '%-task%';"));
    }

    /**
     * @param string $name
     * @param string $upload
     * @return mixed
     */
    public function createComplaintMedia($name = '', $upload = '')
    {
        return Media::create([
            'name' => $name,
            'path' => $upload
        ]);
    }

    /**
     * @param int $complaint_id
     * @param int $media_id
     * @param string $time
     * @return mixed
     */
    public function assignComplaintMedia($complaint_id = 0, $media_id = 0, $time = '')
    {
        return DB::table('complaint_media')->insert([
            'complaint_id' => $complaint_id,
            'media_id' => $media_id,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    /**
     * @param int $complaint_id
     * @return mixed
     */
    public function getComplaint(int $complaint_id)
    {
        return Complaint::where('id', '=', $complaint_id)->first();
    }

    /**
     * @param string $from_date
     * @param string $to_date
     * @param string $condition
     * @return mixed
     */
    public function getFeedbackForReports(string $from_date, string $to_date, string $condition)
    {
        return DB::select(DB::raw("select max(checklist_items.name)              as checklist_item_name,
       max(checklist_item_feedbacks.feedback) as checklist_feedback,
       max(checklist_item_feedbacks.audio)    as checklist_audio,
       max(checklists.title)                  as checklist_title,
       concat(
           max(clients.name), ', ',
           max(clients.street_number), ', ',
           max(clients.street_name), ', ',
           max(clients.city), ', ',
           max(clients.post_code)
         )                                    as client,
       concat(
           max(cleaners.first_name), ' ',
           max(cleaners.last_name), ', ',
           max(cleaners.street_number), ', ',
           max(cleaners.street_name), ', ',
           max(cleaners.city), ', ',
           max(cleaners.post_code)
         )                                    as cleaner,
       concat(
           max(inspectors.first_name), ' ',
           max(inspectors.last_name), ', ',
           max(inspectors.street_number), ', ',
           max(inspectors.street_name), ', ',
           max(inspectors.city), ', ',
           max(inspectors.post_code)
         )                                    as inspector,
       max(categories.name)                   as category_name,
       max(checklist_item_feedbacks.id)       as checklist_item_feedback_id
from checklist_item_feedbacks
       inner join checklist_items on checklist_item_feedbacks.checklist_item_id = checklist_items.id
       inner join checklists on checklist_items.checklist_id = checklists.id
       inner join categories on checklists.category_id = categories.id
       inner join tasks on checklist_item_feedbacks.task_id = tasks.id
       inner join clients on tasks.client_id = clients.id
       inner join inspector_schedules on checklist_item_feedbacks.inspector_schedule_id = inspector_schedules.id
       inner join cleaner_schedules on tasks.id = cleaner_schedules.task_id
       inner join inspectors on checklist_item_feedbacks.inspector_id = inspectors.id
       inner join cleaners on cleaner_schedules.cleaner_id = cleaners.id
WHERE checklist_item_feedbacks.created_at >= '$from_date'
  AND checklist_item_feedbacks.created_at <= '$to_date' $condition
group by checklist_item_feedbacks.id;
"));
    }

    /**
     * @param int $task_id
     * @param int $cleaner_id
     * @return mixed
     */
    public function getComplaintsForTasksClients(int $task_id, int $cleaner_id)
    {
        return Complaint::where('task_id', '=', $task_id)->where('cleaner_id', '=', $cleaner_id)->get();
    }

    /**
     * @param int $checklist_item_feedback_id
     * @return mixed
     */
    public function getFeedbackMedia(int $checklist_item_feedback_id)
    {
        return ChecklistItemFeedback::whereId($checklist_item_feedback_id)->first()->media()->get();
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function getComplaintByTask(string $message)
    {
        return Complaint::where('ticket', '=', $message)->first();
    }

    /**
     * @param int $complaint_id
     * @return mixed
     */
    public function deleteComplaint(int $complaint_id)
    {
        return Complaint::whereId($complaint_id)->delete();
    }

    /**
     * @param int $complaint_id
     * @return mixed
     */
    public function deleteComplaintMedia(int $complaint_id)
    {
        return ComplaintMedia::where('complaint_id', '=', $complaint_id)->delete();
    }

    /**
     * @param int $complaint_id
     * @return mixed
     */
    public function deleteComplaintFollowups(int $complaint_id)
    {
        return ComplaintFollowup::where('complaint_id', '=', $complaint_id)->delete();
    }
}