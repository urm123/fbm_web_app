<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Complaint
 *
 * @mixin \Eloquent
 */
class Complaint extends Model
{
    protected $fillable = ['cleaner_id', 'task_id', 'client_id', 'inspector_id', 'ticket', 'date', 'complaint', 'upload'];
}
