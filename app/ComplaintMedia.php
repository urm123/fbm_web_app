<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ComplaintMedia
 *
 * @mixin \Eloquent
 */
class ComplaintMedia extends Model
{
    protected $fillable = [
        'media_id',
        'complaint_id',
        'type',
    ];
}
