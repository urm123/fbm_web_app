<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'qty',
        'units',
        'available',
        'shortage_alert',
        'description',
        'type',
        'product_code',
    ];
}