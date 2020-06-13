<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Feedback
 *
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    protected $fillable = ['client_id', 'cleaner_id', 'inspector_id', 'task_id', 'date', 'feedback', 'rating'];
}
