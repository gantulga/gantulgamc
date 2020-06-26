<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Observers\HasAuthorObservantTrait;

class Procurement extends Model
{
    use SoftDeletes;
    use HasAuthorObservantTrait;
    use HasPublishStatusTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date', 'end_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'props' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query
            ->whereDate('start_date', '<=', Carbon::today()->toDateString())
            ->whereDate('end_date', '>=', Carbon::today()->toDateString());
    }

    public function scopeEnded($query)
    {
        return $query->whereDate('end_date', '<', Carbon::today()->toDateString());
    }
}
