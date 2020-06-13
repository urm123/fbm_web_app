<?php
/**
 * Created by PhpStorm.
 * User: janaka
 * Date: 23/01/19
 * Time: 11:34 AM
 */

namespace App\Repositories;

use App\CleanerCheckList;
use App\CleanerCheckListItems;
use App\Checklist;
use App\Client;
use App\ChecklistItem;
use App\ChecklistItemFeedback;
use App\Media;
use Illuminate\Support\Facades\DB;

/**
 * Class ChecklistRepository
 * @package App\Repositories
 */
class ChecklistRepository
{
    /**
     * @param int $clientId
     * @param string $title
     * @param int $order
     * @return mixed
     */
    public function createCleanerChecklist(int $clientId, string $title, int $order)
    {
        return CleanerCheckList::create([
            'client_id' => $clientId,
            'title' => $title,
            'order' => $order,
        ]);
    }

    /**
     * @param int $checklist_id
     * @param string $name
     * @param int $order
     * @return mixed
     */
    public function createCleanerChecklistItem(int $checklist_id, string $name, int $order)
    {
        return CleanerCheckListItems::create([
            'checklist_id' => $checklist_id,
            'name' => $name,
            'order' => $order
        ]);
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getCleanerChecklistsByClient(int $client_id)
    {
        return Client::find($client_id)->cleanerChecklists;
    }

    /**
     * @param int $checklist_id
     * @return mixed
     */
    public function getCleanerChecklistItems(int $checklist_id)
    {
        //return CleanerCheckListItems::find($checklist_id)->cleanerChecklistItems;
        return CleanerCheckListItems::where('checklist_id', '=', $checklist_id)->get();
    }

    /**
     * @return mixed
     */
    public function getChecklists()
    {
        return Checklist::get();
    }

    /**
     * @param int $category
     * @param string $title
     * @param int $order
     * @return mixed
     */
    public function createChecklist(int $category, string $title, int $order)
    {
        return Checklist::create([
            'category_id' => $category,
            'title' => $title,
            'order' => $order,
        ]);
    }

    /**
     * @param int $checklist_id
     * @param string $name
     * @param int $order
     * @return mixed
     */
    public function createChecklistItem(int $checklist_id, string $name, int $order)
    {
        return ChecklistItem::create([
            'checklist_id' => $checklist_id,
            'name' => $name,
            'order' => $order,
        ]);
    }

    /**
     * @param int $category_id
     * @return mixed
     */
    public function getChecklistsByCategory(int $category_id)
    {
        return Checklist::where('category_id', '=', $category_id)->get();
    }

    /**
     * @param array $request
     * @return ChecklistItemFeedback
     */
    public function createChecklistItemFeedback(array $request)
    {
        $checklist_item_feedback = new ChecklistItemFeedback($request);
        $checklist_item_feedback->save();
        return $checklist_item_feedback;
    }

    /**
     * @param int $checklist_item_id
     * @param string $image_path
     * @return mixed
     */
    public function saveMedia(int $checklist_item_id, string $image_path)
    {
        return Media::create([
            'name' => 'checklist_item_' . $checklist_item_id,
            'path' => $image_path,
        ]);
    }

    /**
     * @param int $checklist_item_id
     * @return mixed
     */
    public function getChecklistItem(int $checklist_item_id)
    {
        return ChecklistItem::where('id', '=', $checklist_item_id)->first();
    }

    /**
     * @param int $cleaners_id
     * @return mixed
     */
    public function getCleanerRating(int $cleaners_id)
    {
        return DB::select(DB::raw("select count(checklist_item_feedbacks.id) as count, sum(checklist_item_feedbacks.feedback) as sum
from checklist_item_feedbacks
       inner join tasks on checklist_item_feedbacks.task_id = tasks.id
       inner join cleaner_task on tasks.id = cleaner_task.task_id
where cleaner_id = $cleaners_id;"));
    }

    /**
     * @param int $cleanerId
     * @param int $clientId
     * @return mixed
     */
    public function getCleanerRatingByClient(int $cleanerId, int $clientId)
    {
        return DB::select(DB::raw("select count(checklist_item_feedbacks.id) as count, sum(checklist_item_feedbacks.feedback) as sum
from checklist_item_feedbacks
       inner join tasks on checklist_item_feedbacks.task_id = tasks.id
       inner join cleaner_task on tasks.id = cleaner_task.task_id
where cleaner_id = $cleanerId and client_id=$clientId;"));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getLastInspectionDetails(int $client_id)
    {
        return DB::select(DB::raw("select checklist_item_feedbacks.*,
       inspectors.*,checklist_item_feedbacks.created_at as last_date
from checklist_item_feedbacks
       inner join inspectors on checklist_item_feedbacks.inspector_id = inspectors.id
       inner join tasks on checklist_item_feedbacks.task_id = tasks.id
where client_id = $client_id
order by checklist_item_feedbacks.created_at desc limit 1;"));
    }

    public function getLastTaskInspectionDetails(int $task_id)
    {
        return DB::select(DB::raw("select checklist_item_feedbacks.*,
       inspectors.*,checklist_item_feedbacks.created_at as last_date
from checklist_item_feedbacks
       inner join inspectors on checklist_item_feedbacks.inspector_id = inspectors.id
       inner join tasks on checklist_item_feedbacks.task_id = tasks.id
where task_id = $task_id
order by checklist_item_feedbacks.created_at desc limit 1;"));
    }

    /**
     * @param int $client_id
     * @param int $cleaner_id
     * @return mixed
     */
    public function getCleanerRatingForClient(int $client_id, int $cleaner_id)
    {
        return DB::select(DB::raw("select sum(feedback)   as sum,
       count(feedback) as count
from checklist_item_feedbacks
       inner join tasks on checklist_item_feedbacks.task_id = tasks.id
       inner join cleaner_task on tasks.id = cleaner_task.task_id
where client_id = $client_id
  and cleaner_id = $cleaner_id;"));
    }
}