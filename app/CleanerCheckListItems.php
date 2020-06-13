<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CleanerCheckListItems
 * @package App
 */
class CleanerCheckListItems extends Model
{
    protected $fillable = ['checklist_id', 'name', 'order'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cleanerChecklist()
    {
        return $this->belongsTo(CleanerCheckList::class);
    }
}
