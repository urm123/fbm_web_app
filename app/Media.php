<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Media
 *
 * @mixin \Eloquent
 */
class Media extends Model
{
    protected $fillable = ['id', 'name', 'path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function checklist_item_feedbacks()
    {
        return $this->belongsToMany(ChecklistItemFeedback::class)->withTimestamps();
    }
}
