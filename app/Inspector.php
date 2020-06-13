<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Inspector
 *
 * @mixin \Eloquent
 */
class Inspector extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'street_number',
        'street_name',
        'city',
        'post_code',
        'telephone',
        'mobile',
        'agreement_start',
        'pan_number',
        'initial_password',
        'termination',
        'level',
        'image',
    ];

    protected $dates = ['deleted_at'];

    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checklistItemFeedback()
    {
        return $this->hasMany(ChecklistItemFeedback::class);
    }
}
