<?php

namespace Erdenetmc\MediaField;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Erdenetmc\MediaField\Http\Controllers\RemoveController;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('media-field', __DIR__.'/../dist/js/field.js');
            Nova::style('media-field', __DIR__.'/../dist/css/field.css');
        });

    }

    /**
     * Register the field's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->prefix('nova-vendor/media-field')
            ->delete('/{resource}/{resourceId}/{relatedResource}/{relatedResourceId}/field/{field}', RemoveController::class . '@handle');
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
