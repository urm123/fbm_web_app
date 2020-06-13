<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ClientFollowupComment
 *
 * @mixin \Eloquent
 */
class ClientFollowupComment extends Model
{
    protected $fillable = [
        'client_followup_id',
        'admin_id',
        'date',
        'upload',
        'comment',
        'description',
    ];
}
