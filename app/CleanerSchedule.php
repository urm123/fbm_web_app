<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CleanerSchedule
 *
 * @mixin \Eloquent
 */
class CleanerSchedule extends Model
{
    protected $fillable = ['cleaner_id', 'task_id', 'start_time', 'end_time'];
}
