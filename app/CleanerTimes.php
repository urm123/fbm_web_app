<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CleanerTimes extends Model
{
    protected $fillable = [
        'client_id',
        'cleaner_id',
        'client_sub_id',
        'work_days',
        'work_date',
        'time',
        'mobile',
        'telephone',
        'number_of_people',
        'time_in',
        'time_out'
    ];
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class);
    }
}
