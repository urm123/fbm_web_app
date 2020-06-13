<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Client
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $fillable = [
        'name',
        'street_number',
        'street_name',
        'city',
        'post_code',
        'continuous',
        'supply_required',
        'termination_date',
        'start_date',
        'lock_code',
        'alarm_code',
        'payment',
        'category_id',
        'contract',
    ];

    protected $dates = ['deleted_at'];
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cleanerChecklists()
    {
        return $this->hasMany(CleanerCheckList::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
