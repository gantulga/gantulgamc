<?php

namespace App\Policies;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class DefaultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionTo($this->permissionName());
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function view(User $user, Model $model)
    {
        return $user->checkPermissionTo($this->permissionName());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionTo($this->permissionName());
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function update(User $user, Model $model)
    {
        return $user->checkPermissionTo($this->permissionName());
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function delete(User $user, Model $model)
    {
        return $user->checkPermissionTo($this->permissionName());
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function restore(User $user, Model $model)
    {
        return $user->checkPermissionTo($this->permissionName());
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function forceDelete(User $user, Model $model)
    {
        return $user->isSuperAdmin() && $user->checkPermissionTo($this->permissionName());
    }

    private function permissionName()
    {
        return str_replace(['Policy','\Policies'], '', get_class($this));
    }

}
