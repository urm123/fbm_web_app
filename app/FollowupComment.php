<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FollowupComment
 *
 * @mixin \Eloquent
 */
class FollowupComment extends Model
{
    protected $fillable = [
        'followup_id',
        'admin_id',
        'inspector_id',
        'upload',
        'date',
        'comment',
        'description',
    ];
}
