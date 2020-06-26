<?php

namespace Qz\GutenbergField;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            //Nova::script('gutenberg-global', __DIR__.'/../dist/js/global.js');
            Nova::script('react', config('nova.gutenberg-field.react_url', 'https://unpkg.com/react@16.6.3/umd/react.production.min.js'));
            Nova::script('react-dom', config('nova.gutenberg-field.react_dom_url', 'https://unpkg.com/react-dom@16.6.3/umd/react-dom.production.min.js'));
            //Nova::script('moment', config('nova.gutenberg-field.moment_url', 'https://unpkg.com/moment@2.22.1/min/moment.min.js'));
            Nova::script('jquery', config('nova.gutenberg-field.jquery_url', 'https://code.jquery.com/jquery-1.12.4.min.js'));

            Nova::script('gutenberg-field', __DIR__.'/../dist/js/field.js');
            Nova::style('gutenberg-field', __DIR__.'/../dist/css/field.css');
        });
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
