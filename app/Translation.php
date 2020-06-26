<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'props' => 'array',
    ];

    public function translatable()
    {
        return $this->morphTo();
    }
}
