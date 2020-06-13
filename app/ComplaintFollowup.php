<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ComplaintFollowup
 *
 * @mixin \Eloquent
 */
class ComplaintFollowup extends Model
{
    protected $fillable = [
        'complaint_id',
        'admin_id',
        'comment',
        'description',
        'upload',
        'date',
    ];
}
