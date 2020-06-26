<?php

namespace App\Policies;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormEntryPolicy extends DefaultPolicy
{
    /**
     * Determine whether the user can create form submissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
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
        return false;
    }
}
