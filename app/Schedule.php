<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Schedule
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @mixin \Eloquent
 * Class Schedule
 * @package App
 */
class Schedule extends Model
{
    protected $fillable = [
        'repeat',
        'start_time',
        'end_time',
        'repeat_mode',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
