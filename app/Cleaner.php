<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Cleaner
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @mixin \Eloquent
 */
class Cleaner extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'mobile',
        'telephone',
        'street_number',
        'street_name',
        'city',
        'post_code',
        'start_date',
        'type',
        'pan_number',
        'initial_password',
        'termination',
        'image',
    ];


    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
