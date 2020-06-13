<?php
/**
 * Created by PhpStorm.
 * User: janaka
 * Date: 3/20/18
 * Time: 12:24 PM
 */

namespace App\Support;


use App\Repositories\ChecklistRepository;
use App\Repositories\FeedbackRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

/**
 * Class ReportsSupport
 * @package App\Support
 */
class ReportsSupport
{
    protected $product;
    protected $user;
    protected $feedback;
    protected $checklist;
    protected $task;

    /**
     * ReportsSupport constructor.
     * @param ProductRepository $product_repository
     * @param UserRepository $user_repository
     * @param FeedbackRepository $feedback_repository
     * @param ChecklistRepository $checklist_repository
     * @param TaskRepository $task_repository
     */
    function __construct(
        ProductRepository $product_repository,
        UserRepository $user_repository,
        FeedbackRepository $feedback_repository,
        ChecklistRepository $checklist_repository,
        TaskRepository $task_repository
    )
    {
        $this->product = $product_repository;
        $this->user = $user_repository;
        $this->feedback = $feedback_repository;
        $this->checklist = $checklist_repository;
        $this->task = $task_repository;
    }

    /**
     * @return array
     */
    public function store()
    {
        $inventory = $this->product->getInventory();
        $columns = [
            [
                'key' => 'client_name',
                'value' => 'Client'
            ],
            [
                'key' => 'product_name',
                'value' => 'Product'
            ],
            [
                'key' => 'price',
                'value' => 'Price'
            ],
            [
                'key' => 'qty',
                'value' => 'Quantity'
            ],
            [
                'key' => 'shortage_alert',
                'value' => 'Minimum Amount'
            ],
            [
                'key' => 'stock_date',
                'value' => 'Client Allocation Date'
            ],
        ];
        return ['data' => $inventory, 'columns' => $columns];
    }

    /**
     * @return array
     */
    public function clients()
    {
        $request = Request::all();
        $from_date = Carbon::parse($request['from_date'])->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request['to_date'] . ' 23:59:59')->format('Y-m-d H:i:s');
        $client = $request['client'];
        $cleaner = $request['cleaner'];
        $inspector = $request['inspector'];
        $category = $request['category'];
        $continuous = $request['continuous'];
        $city = $request['city'];

        $condition = '';

        if ($client != '') {
            $condition .= " AND clients.id = " . $client;
        }

        if ($cleaner != '') {
            $condition .= " AND cleaners.id = " . $cleaner;
        }

        if ($inspector != '') {
            $condition .= " AND inspectors.id = " . $inspector;
        }
        if ($category != '') {
            $condition .= " AND category_id = " . $category;
        }
        if ($continuous != '') {
            $condition .= " AND continuous is " . $continuous;
        }
        if ($city != '') {
            $condition .= " AND clients.city like '" . $city . "'";
        }

        $clients = $this->user->getClientsForClientsReports($from_date, $to_date, $condition);

        foreach ($clients as $client) {
            $client->task_items = $this->task->getTaskItemsForTasks($client->task_id);
            $client->task_list = '';
            foreach ($client->task_items as $task_item) {
                $client->task_list .= $task_item->task_item_name . ', ';
            }

            $cleaner_schedule = $this->task->getCleanerSchedule($client->task_id, Carbon::parse($from_date)->toDateString());
            $task_items = $this->task->getTaskItems($client->task_id);
            if (count($cleaner_schedule)) {
                $task_item_status = $this->task->getTaskItemStatus($cleaner_schedule[0]->id);

                foreach ($task_items as $task_item) {
                    $finished = false;
                    foreach ($task_item_status as $status) {
                        if ($task_item->id == $status->task_item_id) {
                            if ($status->status == "FINISHED") {
                                $finished = true;
                            }
                        }
                    }

                    $task_item->status = $finished;
                }

                $client->task_items = $task_items;
            } else {
                $client->task_items = $task_items;
            }

            $client->complete_count = 0;
            $client->incomplete_count = 0;

            foreach ($client->task_items as $task_item) {
                if ($task_item->status) {
                    $client->complete_count++;
                } else {
                    $client->incomplete_count++;
                }
            }

            if ($client->repeat_mode) {
                $client->cleaning_dates = $client->repeat_mode;
            } else {
                $client->cleaning_dates = $client->start_time;
            }

            $inspector_feedback = $this->checklist->getLastInspectionDetails($client->client_id);
            if ($inspector_feedback) {
                $client->inspector_name = $inspector_feedback[0]->first_name . ' ' . $inspector_feedback[0]->last_name;
                $client->inspector_feedback_last_date = Carbon::parse($inspector_feedback[0]->last_date)->toFormattedDateString();
                $client->inspector_feedback_feedback = $inspector_feedback[0]->feedback;
            } else {
                $client->inspector_name = '';
                $client->inspector_feedback_last_date = '';
                $client->inspector_feedback_feedback = '';
            }

            $client->cleaner_rating = $this->checklist->getCleanerRatingForClient($client->client_id, $client->cleaner_id);

            if ($client->cleaner_rating[0]->count > 0) {
                $client->cleaner_rating_total = number_format($client->cleaner_rating[0]->sum / $client->cleaner_rating[0]->count, 2, '.', '');
            } else {
                $client->cleaner_rating_total = 0;
            }
        }

        $columns = [
            [
                'key' => 'name',
                'value' => 'Name'
            ],
            [
                'key' => 'address',
                'value' => 'Address'
            ],
            [
                'key' => 'category',
                'value' => 'Class'
            ],
            [
                'key' => 'continuous',
                'value' => 'Continuous'
            ],
            [
                'key' => 'supply_required',
                'value' => 'Supply Required'
            ],

            [
                'key' => 'cleaning_dates',
                'value' => 'Cleaning Dates'
            ],
            [
                'key' => 'task_list',
                'value' => 'Sub Items'
            ],
            [
                'key' => 'cleaner',
                'value' => 'Cleaner'
            ],
            [
                'key' => 'inspector_name',
                'value' => 'Inspector',
            ],
            [
                'key' => 'inspector_feedback_last_date',
                'value' => 'Last Inspection Date'
            ],
            [
                'key' => 'inspector_feedback_feedback',
                'value' => 'Last Feedback',
            ],
            [
                'key' => 'incomplete_count',
                'value' => 'Incomplete',
            ],
            [
                'key' => 'complete_count',
                'value' => 'Complete',
            ],
            [
                'key' => 'cleaner_rating_total',
                'value' => 'Cleaner Feedback for this Client',
            ],
            [
                'key' => 'deleted_at',
                'value' => 'Terminated'
            ],
        ];
        return ['data' => $clients, 'columns' => $columns];
    }

    /**
     * @return array
     */
    public function complaints()
    {
        $request = Request::all();
        $from_date = Carbon::parse($request['from_date'])->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request['to_date'] . ' 23:59:59')->format('Y-m-d H:i:s');
        $client = $request['client'];
        $cleaner = $request['cleaner'];
        $inspector = $request['inspector'];

        $condition = '';

        if ($client != '') {
            $condition .= " AND clients.id = " . $client;
        }

        if ($cleaner != '') {
            $condition .= " AND cleaners.id = " . $cleaner;
        }

        if ($inspector != '') {
            $condition .= " AND inspectors.id = " . $inspector;
        }

        $complaints = $this->feedback->getComplaintsForReports($from_date, $to_date, $condition);

        foreach ($complaints as $complaint) {
            if ($complaint->resolved) {
                $complaint->resolved = 'Yes';
            } else {
                $complaint->resolved = 'No';
            }
        }

        $columns = [
            [
                'key' => 'client',
                'value' => 'Client'
            ],
            [
                'key' => 'complaint',
                'value' => 'Complaint'
            ],
            [
                'key' => 'cleaner',
                'value' => 'Cleaner'
            ],
            [
                'key' => 'inspector',
                'value' => 'Inspector'
            ],
            [
                'key' => 'date',
                'value' => 'Time'
            ],
            [
                'key' => 'resolved',
                'value' => 'Approved By Admin'
            ],
        ];
        return ['data' => $complaints, 'columns' => $columns];
    }

    /**
     * @return array
     */
    public function cleaners()
    {

        $request = Request::all();

        $cleaner = $request['cleaner'];
        $client = $request['client'];
        $from_date = Carbon::parse($request['from_date'])->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request['to_date'] . ' 23:59:59')->format('Y-m-d H:i:s');


        $conditions = '';

        if ($cleaner != '') {
            $conditions .= " AND cleaners.id=" . $cleaner;
        }

        if ($client != '') {
            $conditions .= " AND clients.id=" . $client;
        }

        $seconds = 0;

        $clients = $this->user->getCleanerClientDetails($from_date, $to_date, $conditions);

        foreach ($clients as $client) {
            $client->absent = false;
            if ($client->working_hours != '') {
                $time = explode(':', $client->working_hours);
                $seconds += (int)$time[0] * 3600 + (int)$time[1] * 60 + (int)$time[2];
            } else {
                if ($client->cleaner_start_time == '' && $client->cleaner_end_time == '') {
                    $client->absent = true;
                }
            }

            if ($client->deleted != '') {
                $client->deleted = 'Terminated. For: ' . $client->reason;
            } else {
                $client->deleted = 'Active';
            }

            $task_items = $this->task->getTaskItems($client->task_id);
            if ($client->cleaner_schedule_id) {
                $task_item_status = $this->task->getTaskItemStatus($client->cleaner_schedule_id);

                foreach ($task_items as $task_item) {
                    $finished = false;
                    foreach ($task_item_status as $status) {
                        if ($task_item->id == $status->task_item_id) {
                            if ($status->status == "FINISHED") {
                                $finished = true;
                            }
                        }
                    }

                    $task_item->status = $finished;
                }

                $client->task_items = $task_items;
            } else {
                $client->task_items = $task_items;
            }

            $client->complete_count = 0;
            $client->incomplete_count = 0;

            foreach ($client->task_items as $task_item) {
                if ($task_item->status) {
                    $client->complete_count++;
                } else {
                    $client->incomplete_count++;
                }
            }


            $cleaner_rating = $this->checklist->getCleanerRatingByClient($client->cleaners_id, $client->client_id);
            if ($cleaner_rating[0]->count > 0) {
                $client->rating = number_format($cleaner_rating[0]->sum / $cleaner_rating[0]->count, 0, '.', '');
            } else {
                $client->rating = 0;
            }

            $client->complaints = $this->feedback->getComplaintsForTasksClients($client->task_id, $client->cleaners_id);

            if ($client->absent) {
                $client->working_hours = 'Absent';
            }

        }

        $hours = (int)($seconds / 3600);

        $hour_remainder = $seconds % 3600;

        $minutes = (int)($hour_remainder / 60);

        $minute_remainder = $hour_remainder % 60;

        $total = $hours . ':' . $minutes . ':' . $minute_remainder;


        $columns = [
            [
                'key' => 'cleaner',
                'value' => 'Cleaner'
            ],
            [
                'key' => 'client',
                'value' => 'Client'
            ],
            [
                'key' => 'cleaner_start_time',
                'value' => 'Start Time'
            ],
            [
                'key' => 'cleaner_end_time',
                'value' => 'End Time'
            ],
            [
                'key' => 'working_hours',
                'value' => 'Working Hours'
            ],
            [
                'key' => 'deleted',
                'value' => 'Status'
            ],
            [
                'key' => 'rating',
                'value' => 'Rating'
            ],
            [
                'key' => 'incomplete_count',
                'value' => 'Incomplete'
            ],
            [
                'key' => 'complete_count',
                'value' => 'Complete'
            ],
        ];
        return ['data' => $clients, 'columns' => $columns, 'total' => $total];
    }

    /**
     * @return array
     */
    public function tasks()
    {

        $request = Request::all();

        $cleaner = $request['cleaner'];
        $client = $request['client'];
        $inspector = $request['inspector'];
        $from_date = Carbon::parse($request['from_date'])->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request['to_date'] . ' 23:59:59')->format('Y-m-d H:i:s');

        $conditions = '';

        if ($cleaner != '') {
            $conditions .= " AND cleaners.id=" . $cleaner;
        }

        if ($client != '') {
            $conditions .= " AND clients.id=" . $client;
        }

        if ($inspector != '') {
            $conditions .= " AND inspectors.id=" . $inspector;
        }


        $clients = $this->user->getClientTasksDetails($from_date, $to_date, $conditions);

        foreach ($clients as $client) {
            $sub_tasks = $this->user->getClientSubTasks($client->task_id);
            $sub_tasks_array = [];
            foreach ($sub_tasks as $sub_task) {
                $sub_tasks_array[] = $sub_task->name;
            }
            $client->task_items = implode(', ', $sub_tasks_array);

            if ($client->task_repeat && strpos($client->repeat_mode, '_') !== false) {
                $repeat_modes = explode('_', $client->repeat_mode);
                $repeat_text = '';
                foreach ($repeat_modes as $repeat_mode) {
                    if ($repeat_mode != '') {
                        switch ($repeat_mode) {
                            case '0':
                                $repeat_text .= 'Sunday, ';
                                break;
                            case '1':
                                $repeat_text .= 'Monday, ';
                                break;
                            case '2':
                                $repeat_text .= 'Tuesday, ';
                                break;
                            case '3':
                                $repeat_text .= 'Wednesday, ';
                                break;
                            case '4':
                                $repeat_text .= 'Thursday, ';
                                break;
                            case '5':
                                $repeat_text .= 'Friday, ';
                                break;
                            case '6':
                                $repeat_text .= 'Saturday, ';
                                break;
                            default:
                                break;
                        }
                    }
                }
                $client->repeat_mode = $repeat_text;
            }

            $client->cleaner_name = $client->cleaner_first_name . ' ' . $client->cleaner_last_name . ' ' . $client->cleaner_number;
            $client->inspector_name = $client->inspector_first_name . ' ' . $client->inspector_last_name . ' ' . $client->inspector_number;
            if ($client->task_repeat) {
                $client->task_repeat = 'Yes';
            } else {
                $client->task_repeat = 'No';
            }
        }


        $columns = [
            [
                'key' => 'client_name',
                'value' => 'Client'
            ],
            [
                'key' => 'cleaner_name',
                'value' => 'Cleaner'
            ],
            [
                'key' => 'inspector_name',
                'value' => 'Inspector'
            ],
            [
                'key' => 'task_name',
                'value' => 'Task Name'
            ],
            [
                'key' => 'start_time',
                'value' => 'Start Time'
            ],
            [
                'key' => 'end_time',
                'value' => 'End Time'
            ],
            [
                'key' => 'task_items',
                'value' => 'Task Items'
            ],
            [
                'key' => 'task_repeat',
                'value' => 'Repeat'
            ],
            [
                'key' => 'repeat_mode',
                'value' => 'Repeat Time'
            ],
        ];
        return ['data' => $clients, 'columns' => $columns];
    }

    /**
     * @return array
     */
    public function inspectors()
    {

        $request = Request::all();

        $inspector = $request['inspector'];
        $client = $request['client'];
        $from_date = Carbon::parse($request['from_date'])->format('Y-m-d H:i:s');
        $to_date = Carbon::parse($request['to_date'] . ' 23:59:59')->format('Y-m-d H:i:s');
        $absent = $request['absent'];
        $inspectorLevel = $request['inspectorLevel'];

        $conditions = '';

        if ($inspector != '') {
            $conditions .= " AND inspectors.id=" . $inspector;
        }

        if ($client != '') {
            $conditions .= " AND clients.id=" . $client;
        }

        if ($absent != '') {
            if ($absent == 'true') {
                $conditions .= ' and inspector_schedules.start_time is null and inspector_schedules.end_time is null ';
            } else {
                $conditions .= ' and inspector_schedules.start_time is not null or inspector_schedules.end_time is not null ';
            }
        }

        if ($inspectorLevel != '') {
            $conditions .= " AND inspectors.level=" . $inspectorLevel;
        }

        $clients = $this->user->getInspectorClientDetails($from_date, $to_date, $conditions);

        $seconds = 0;

        foreach ($clients as $client) {

            $client->absent = false;
            if ($client->working_hours != '') {
                $time = explode(':', $client->working_hours);
                $seconds += (int)$time[0] * 3600 + (int)$time[1] * 60 + (int)$time[2];
            } else {
                if ($client->inspector_start_time == '' && $client->inspector_end_time == '') {
                    $client->absent = true;
                }
            }

            $client->absent = false;
            if ($client->deleted != '') {
                $client->deleted = 'Terminated. For: ' . $client->reason;
            } else {
                $client->deleted = 'Active';
            }

            $inspector_feedback = $this->checklist->getLastTaskInspectionDetails($client->task_id);

            if ($inspector_feedback) {
                $client->inspector_feedback = $inspector_feedback[0];
                $client->inspector_feedback->last_date = Carbon::parse($client->inspector_feedback->last_date)->toFormattedDateString() . ' ' . Carbon::parse($client->inspector_feedback->last_date)->format('g:iA');
            } else {
                $client->inspector_feedback = [];
            }

            $client->last_date = '';

            if ($client->inspector_feedback) {
                $client->last_date = $client->inspector_feedback->last_date;
            }

            $client->rating = '';

            if ($client->inspector_feedback) {
                for ($i = 1; $i <= $client->inspector_feedback->feedback; $i++) {
                    $client->rating .= '*';
                }

            }

            $client->inspector_level = 'Inspector 1';

            if ($client->level == 'INSPECTOR_2') {
                $client->inspector_level = "Inspector 2";
            }


        }

        $hours = (int)($seconds / 3600);

        $hour_remainder = $seconds % 3600;

        $minutes = (int)($hour_remainder / 60);

        $minute_remainder = $hour_remainder % 60;

        $total = $hours . ':' . $minutes . ':' . $minute_remainder;

        $columns = [
            [
                'key' => 'inspector',
                'value' => 'Inspector'
            ],
            [
                'key' => 'client',
                'value' => 'Client'
            ],
            [
                'key' => 'inspector_level',
                'value' => 'Level'
            ],
            [
                'key' => 'last_date',
                'value' => 'Inspection Time'
            ],
            [
                'key' => 'working_hours',
                'value' => 'Working Hours'
            ],
            [
                'key' => 'rating',
                'value' => 'Rating'
            ],
            [
                'key' => 'deleted',
                'value' => 'Status'
            ],
        ];
        return ['data' => $clients, 'columns' => $columns];
    }
}
