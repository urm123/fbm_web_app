<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TaskItemStatus
 *
 * @mixin \Eloquent
 */
class TaskItemStatus extends Model
{
    protected $table = 'task_item_status';

    protected $fillable = [
        'task_item_id',
        'schedule_task_id',
        'cleaner_schedule_id',
        'status',
        'date',
    ];
}
