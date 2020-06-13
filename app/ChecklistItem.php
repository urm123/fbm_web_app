<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ChecklistItem
 * @package App
 */
class ChecklistItem extends Model
{
    protected $fillable = ['checklist_id', 'name', 'order', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'sunday' => 'boolean',
        'monday' => 'boolean',
        'tuesday' => 'boolean',
        'wednesday' => 'boolean',
        'thursday' => 'boolean',
        'friday' => 'boolean',
        'saturday' => 'boolean',
    ];

    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checklistItemFeedback()
    {
        return $this->hasMany(ChecklistItemFeedback::class);
    }
}
