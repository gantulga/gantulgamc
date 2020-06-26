<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;

use Whitecube\NovaFlexibleContent\Flexible;

class Form extends Resource
{
    use TabsOnEdit;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Form';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Маягт';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name','title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            (new Tabs('Маягтын дэлгэрэгүй', [
                'Үндсэн мэдээлэл' => [
                    //ID::make()->sortable(),
                    Text::make(__('Title'),'title')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Text::make(__('Slug'),'name')
                        ->sortable()
                        ->rules('required', 'max:255')
                        ->creationRules('unique:forms,name,NULL,id,deleted_at,NULL')
                        ->updateRules('unique:forms,name,{{resourceId}},id,deleted_at,NULL'),

                    Text::make('URL', function(){
                        $url = url('/forms/'.$this->name);
                        return '<a href="'.$url.'" target="blank">'.$url.'</a>';
                    })->onlyOnDetail()->asHtml(),

                    Select::make(__('Status'),'status')
                        ->options(\App\PublishStatus::statuses())
                        ->displayUsingLabels()
                        ->rules('required'),

                    Flexible::make(__('Fields'), 'fields')
                        ->preset(\App\Nova\Flexible\Presets\FormFieldsPreset::class)
                        ->onlyOnForms()
                        ->rules('required'),
                ],
                __('Settings') => [

                    Trix::make(__('Description'), 'settings->description')
                        ->alwaysShow(),

                    Trix::make(__('Success message'), 'settings->success_message')
                        ->alwaysShow(),

                    Text::make(__('Submit text'), 'settings->submit_text')
                        ->sortable()
                        ->rules('max:255')
                        ->hideFromIndex(),

                    Boolean::make(__('Stacked'), 'settings->stacked')
                        ->hideFromIndex(),

                ]

            ]))->withToolbar()->defaultSearch(true),

            HasMany::make(__('Entries'), 'entries', FormEntry::class),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Маягтууд';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Маягт';
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
