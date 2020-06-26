<?php

namespace App\Policies;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy extends DefaultPolicy
{
    /**
     * Determine whether the user can view the company.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionTo(\App\Company::class);
    }
}
