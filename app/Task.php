<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Task
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Cleaner[] $cleaners
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Schedule[] $schedules
 * @mixin \Eloquent
 */
class Task extends Model
{

    protected $fillable = [
        'name',
        'client_id',
        'address',
        'latitude',
        'longitude',
        'type',
        'status',
        'notification',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cleaners()
    {
        return $this->belongsToMany(Cleaner::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checklistItemFeedback()
    {
        return $this->hasMany(ChecklistItemFeedback::class);
    }
}
