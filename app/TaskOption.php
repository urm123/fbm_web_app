<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskOption
 * @package App
 */
class TaskOption extends Model
{
    protected $fillable = ['text', 'type'];
}
