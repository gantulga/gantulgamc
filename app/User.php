<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'props' => 'array',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole($roleName)
    {
        foreach ($this->roles as $role) {
            if (strtolower($role->name) == strtolower($roleName)) {
                return true;
            }
        }
        return false;
    }

    public function checkPermissionTo($permission)
    {
        foreach ($this->roles as $role) {
            if (in_array($permission, $role->permissions)) {
                return true;
            }
        }
        return false;
    }

    public function isSuperAdmin()
    {
        if (in_array($this->email, array_map('trim', explode(',', config('auth.super_admins', ''))))) {
            return true;
        }
        return false;
    }
}
