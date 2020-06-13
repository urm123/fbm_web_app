<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CleanerScheduleProduct
 *
 * @mixin \Eloquent
 */
class CleanerScheduleProduct extends Model
{
    protected $table = 'cleaner_schedule_product';

    protected $fillable = [
        'product_id',
        'cleaner_schedule_id',
        'quantity',
        'date',
    ];
}
