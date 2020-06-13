<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ChecklistItemFeedback
 * @package App
 */
class ChecklistItemFeedback extends Model
{

    protected $dates = ['deleted_at'];

    use SoftDeletes;

    protected $fillable = [
        'checklist_item_id',
        'inspector_id',
        'task_id',
        'inspector_schedule_id',
        'feedback',
        'audio',
        'image',
        'video',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checklistItem()
    {
        return $this->belongsTo(ChecklistItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inspector()
    {
        return $this->belongsTo(Inspector::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inspectorSchedule()
    {
        return $this->belongsTo(InspectorSchedule::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function media()
    {
        return $this->belongsToMany(Media::class)->withTimestamps();
    }
}
