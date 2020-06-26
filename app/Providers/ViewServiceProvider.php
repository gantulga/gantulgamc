<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            [
                'includes.menu-main',
                'includes.menu-footer',
                'includes.menu-sidebar',
                'includes.menu-hr',
                'includes.menu-procurement'
            ], 'App\Http\View\Composers\MenuComposer'
        );

        View::composer(
            'includes.medee', 'App\Http\View\Composers\LatestNewsComposer'
        );

        View::composer(
            'includes.categories', 'App\Http\View\Composers\CategoriesComposer'
        );

        View::composer(
            'includes.hudaldan-avalt', 'App\Http\View\Composers\ProcurementComposer'
        );

        View::composer(
            'includes.ajliin-bair', 'App\Http\View\Composers\JobsComposer'
        );

        View::composer(
            'includes.durem-juram', 'App\Http\View\Composers\LegalDocumentsComposer'
        );

        // Using Closure based composers...
        View::composer('dashboard', function ($view) {
            //
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
