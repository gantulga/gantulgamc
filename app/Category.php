<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\HasParentPathObservantTrait;

class Category extends Model
{
    use SoftDeletes;
    use HasParentPathObservantTrait;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
