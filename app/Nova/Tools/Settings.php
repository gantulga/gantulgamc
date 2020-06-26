<?php

namespace App\Nova\Tools;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Heading;
use App\Nova\Settings as SettingsResource;

class Settings extends Tool
{

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        //Nova::script('settings', __DIR__.'/../dist/js/tool.js');
        //Nova::style('settings', __DIR__.'/../dist/css/tool.css');
        $this->seeCallback = function(){
            return SettingsResource::authorizedToViewAny(request());
        };
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova.settings.navigation');
    }

}
