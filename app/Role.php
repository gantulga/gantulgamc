<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $casts = [
        'permissions' => 'array'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }

}
