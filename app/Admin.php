<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Admin
 *
 * @mixin \Eloquent
 */
class Admin extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'street_number',
        'street_name',
        'city',
        'post_code',
        'level',
        'pan_number',
        'agreement_start',
        'mobile',
        'telephone',
        'initial_password',
        'termination',
    ];

    protected $dates = ['deleted_at'];

    use SoftDeletes;
}
