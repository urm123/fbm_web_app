<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\TaskItem
 *
 * @mixin \Eloquent
 */
class TaskItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'task_id',
        'name',
        'checked'
    ];

    protected $dates = ['deleted_at'];
}
