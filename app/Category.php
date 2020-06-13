<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checklist()
    {
        return $this->hasMany(Checklist::class);
    }
}
