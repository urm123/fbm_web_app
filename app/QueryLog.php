<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\QueryLog
 *
 * @mixin \Eloquent
 */
class QueryLog extends Model
{
    protected $table = 'query_log';

    protected $fillable = [
        'sql', 'bindings', 'time'
    ];
}
