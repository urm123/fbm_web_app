<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AccountingContact
 *
 * @mixin \Eloquent
 */
class AccountingContact extends Model
{
    protected $fillable = [
        'client_id',
        'first_name',
        'email',
        'telephone',
        'post_code',
    ];
}
