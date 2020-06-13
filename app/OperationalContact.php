<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OperationalContact
 *
 * @mixin \Eloquent
 */
class OperationalContact extends Model
{
    protected $fillable = [
        'client_id',
        'first_name',
        'email',
        'telephone',
        'post_code',
    ];
}
