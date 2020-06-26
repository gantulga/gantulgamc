<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait MediableTrait
{
     /**
     * Get all of the tags for the post.
     */
    public function media()
    {
        return $this->morphToMany('App\Media', 'mediable')->withPivot(['collection']);
    }
}