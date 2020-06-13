<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InspectorSchedule
 *
 * @mixin \Eloquent
 */
class InspectorSchedule extends Model
{
    protected $fillable = ['inspector_id', 'task_id', 'start_time', 'end_time'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checklistItemFeedback()
    {
        return $this->hasMany(ChecklistItemFeedback::class);
    }
}
