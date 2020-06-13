<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TaskStatus
 *
 * @mixin \Eloquent
 */
class TaskStatus extends Model
{
    protected $table = 'task_status';

    protected $fillable = [
        'cleaner_schedule_id',
        'schedule_task_id',
        'status',
        'date'
    ];
}
