<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Alert
 *
 * @mixin \Eloquent
 */
class Alert extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'message',
        'type',
        'date',
        'status',
    ];

    protected $dates = ['deleted_at'];
}
