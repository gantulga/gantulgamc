<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Settings;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function ($app) {
            //\Debugbar::enable();
            return Settings::withoutGlobalScopes()->firstOrCreate(['key'=>'app']);
        });
        $this->app->alias(Settings::class, 'settings');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->alterConfig();
    }

    private function alterConfig()
    {
        $config_settings = [
            'app.name' => 'app.name',
            'analytics.view_id' => 'google_analytics.view_id',
            'mail.from.address' => 'mail.from.address',
            'mail.from.name' => 'mail.from.name',
            'mail.host' => 'mail.host',
            'mail.port' => 'mail.port',
            'mail.username' => 'mail.username',
            'mail.password' => 'mail.password',
        ];

        $this->app['config']->set(collect($config_settings)->map(function($setting, $config){
            return settings($setting, config($config));
        })->toArray());

    }
}
