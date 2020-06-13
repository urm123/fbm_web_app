<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ClientFollowup
 *
 * @mixin \Eloquent
 */
class ClientFollowup extends Model
{
    protected $fillable = [
        'client_id',
        'admin_id',
        'type',
        'comment',
        'date',
        'status',
        'task_id'
    ];
}
