<?php

namespace App\Providers;

use App\Company;
use App\Nova\Metrics\NewCompanies;
use App\Nova\Metrics\CompaniesPerDay;
use App\Nova\Metrics\CompaniesPerOwnershipForm;
use App\Nova\Metrics\GAMostVisitedPages;
use App\Nova\Metrics\GAPageViews;
use App\Nova\Metrics\GAVisitors;
use Ericlagarda\NovaTextCard\TextCard;
use IDF\HtmlCard\HtmlCard;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Events\NovaServiceProviderRegistered;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Actions\ActionEvent;
use Techouse\TotalRecords\TotalRecords;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {

        });

        parent::boot();

        Nova::style('nova', public_path('css/nova.css'));
        Nova::script('nova', public_path('js/nova.js'));
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        $routeConfig = [
            'namespace' => 'App\Nova\Http\Controllers',
            'domain' => config('nova.domain', null),
            'as' => 'app.nova.api.',
            'prefix' => 'nova-api',
            'middleware' => 'nova',
        ];

        \Event::listen(NovaServiceProviderRegistered::class, function () use($routeConfig) {
            Route::group($routeConfig, function () {
                Route::get('/{resource}/associatable/{field}', 'AssociatableController@index');
            });
        });

        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();

    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
            return  in_array($user->email, [
                '2000.khz@gmail.com',
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new TextCard)
                //->heading('My custom awesome heading')
                ->text('<h2 class="mb-3"> Сайн байнa уу, '.auth()->user()->name.'!</h2> Тохиргоо цэсийн <a href="/cp/resources/settings/app/edit"><b>Google Analytics</b></a> таб руу орж тохиргоо хийнэ үү.')
                ->textAsHtml()
                ->center(true)
                //->forceFullWidth()
                ->width('2/3'),

            //(new HtmlCard)->width('5/6')->html('<h2> Сайн байнa уу, '.auth()->user()->name.'!</h2>')->center(true),
            (new GAPageViews),
            (new GAMostVisitedPages)->width('2/3'),
            (new GAVisitors),

            (new TotalRecords(\App\Page::class, 'Нийт хуудас')),
            (new TotalRecords(\App\Post::class, 'Нийт мэдээ')),
            (new TotalRecords(\App\User::class, 'Нийт хэрэглэгч')),

            (new NewCompanies)->canSeeWhen('viewAny', Company::class),
            (new CompaniesPerDay)->canSeeWhen('viewAny', Company::class),
            (new CompaniesPerOwnershipForm)->canSeeWhen('viewAny', Company::class),
            //new Help,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \App\Nova\Tools\Settings(),
            (new \Spatie\BackupTool\BackupTool())->canSee(function ($request) {
                return \Auth::user()->hasRole('admin') || \Auth::user()->hasRole('super admin');
            }),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
