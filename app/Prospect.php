<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prospect
 *
 * @package App
 * @mixin \Eloquent
 */
class Prospect extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'telephone',
        'mobile',
        'email',
        'reference',
        'status',
        'sq_footage',
        'address',
        'quote',
    ];
}
