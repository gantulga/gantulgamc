<?php

namespace Erdenetmc\Wysiwyg;

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
            //Nova::script('ckeditor-4', 'https://cdn.ckeditor.com/4.11.4/full/ckeditor.js');
            Nova::script('ckeditor-4', asset('vendor/ckeditor/ckeditor.js'));

            Nova::script('wysiwyg.js', __DIR__.'/../dist/js/field.js');
            Nova::style('wysiwyg.css', __DIR__.'/../dist/css/field.css');
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
