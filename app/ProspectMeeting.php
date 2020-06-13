<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProspectMeeting
 *
 * @mixin \Eloquent
 */
class ProspectMeeting extends Model
{
    protected $fillable = [
        'prospect_id',
        'date',
        'description',
    ];
}
