<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\HasAuthorObservantTrait;

class Media extends Model
{
    use SoftDeletes;
    use HasAuthorObservantTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file', 'original_name', 'size', 'mime_type', 'description'
    ];

    /**
     * Get all of the pages that are assigned this media.
     */
    public function pages()
    {
        return $this->morphedByMany('App\Page', 'mediable')->withPivot(['collection']) ;
    }

    public function scopeIsImage($query)
    {
        return $query->where('mime_type','LIKE','image/%');
    }

}
