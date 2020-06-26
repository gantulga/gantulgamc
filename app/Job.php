<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Observers\HasAuthorObservantTrait;

class Job extends Model
{
    use SoftDeletes;
    use HasAuthorObservantTrait;
    use HasPublishStatusTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'starts_at',
        'expires_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'props' => 'array',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopeNotExpired($query)
    {
        return $query->whereNull('expires_at')->orWhereDate('expires_at', '>=', Carbon::today()->toDateString());
    }

    public static function types()
    {
        $arr = ['бүр', 'түр', 'ээлжийн', 'гэрээт'];
        return array_combine($arr, $arr);
    }

    public static function findByIdBase36($idBase36)
    {
        $id = base_convert($idBase36, 36, 10);
        return self::whereId($id)->first();
    }

    public function id36()
    {
        return str_pad(base_convert($this->id, 10, 36), 4, '0', STR_PAD_LEFT);
    }

    public function isExpired()
    {
        return now() > $this->expires_at;
    }
}
