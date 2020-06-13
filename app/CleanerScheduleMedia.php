<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CleanerScheduleMedia
 *
 * @mixin \Eloquent
 */
class CleanerScheduleMedia extends Model
{
    protected $fillable = ['id', 'media_id', 'cleaner_schedule_id', 'task_item_id'];
}
