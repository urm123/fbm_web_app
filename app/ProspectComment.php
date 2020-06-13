<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProspectComment
 * @package App
 */
class ProspectComment extends Model
{

    protected $fillable = [
        'prospect_id',
        'admin_id',
        'upload',
        'date',
        'comment',
        'description',
    ];
}
