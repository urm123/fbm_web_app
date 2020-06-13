<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Checklist
 * @package App
 */
class Checklist extends Model
{
    protected $fillable = ['category_id', 'title', 'order'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checklistItems()
    {
        return $this->hasMany(ChecklistItem::class);
    }
}
