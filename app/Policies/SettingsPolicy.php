<?php

namespace App\Policies;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingsPolicy extends DefaultPolicy
{

    /**
     * Determine whether the user can create companies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function delete(User $user, Model $model)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the company.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function restore(User $user, Model $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the company.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function forceDelete(User $user, Model $model)
    {
        return false;
    }
}
