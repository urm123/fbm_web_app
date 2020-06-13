<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Followup
 *
 * @mixin \Eloquent
 */
class Followup extends Model
{
    protected $fillable = [
        'client_id',
        'inspector_id',
        'admin_id',
        'type',
        'comment',
        'date',
        'status'
    ];
}
