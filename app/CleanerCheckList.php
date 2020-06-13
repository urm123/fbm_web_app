<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CleanerCheckList
 * @package App
 */
class CleanerCheckList extends Model
{
    protected $fillable = ['client_id', 'title', 'order'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cleanerChecklistItems()
    {
        return $this->hasMany(CleanerCheckListItems::class);
    }
}
