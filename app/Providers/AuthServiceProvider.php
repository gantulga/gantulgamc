<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Category' => 'App\Policies\CategoryPolicy',
        'App\Company' => 'App\Policies\CompanyPolicy',
        'App\Comment' => 'App\Policies\CommentPolicy',
        'App\CompanyReview' => 'App\Policies\CompanyReviewPolicy',
        'App\Form' => 'App\Policies\FormPolicy',
        'App\FormEntry' => 'App\Policies\FormEntryPolicy',
        'App\Job' => 'App\Policies\JobPolicy',
        'App\JobApplication' => 'App\Policies\JobApplicationPolicy',
        'App\LegalDocument' => 'App\Policies\LegalDocumentPolicy',
        'App\LegalDocumentCategory' => 'App\Policies\LegalDocumentCategoryPolicy',
        'App\Media' => 'App\Policies\MediaPolicy',
        'App\Menu' => 'App\Policies\MenuPolicy',
        'App\MenuItem' => 'App\Policies\MenuPolicy',
        'App\Page' => 'App\Policies\PagePolicy',
        'App\Post' => 'App\Policies\PostPolicy',
        'App\Procurement' => 'App\Policies\ProcurementPolicy',
        'App\ProcurementResult' => 'App\Policies\ProcurementResultPolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Settings' => 'App\Policies\SettingsPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->isSuperAdmin() ? true : null;
        });

    }

}
