<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Date;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class Procurement extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Procurement';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Худалдан авалт';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name', 'number',
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
            //ID::make()->sortable(),

            Text::make('Дугаар', 'number')
                ->sortable()
                ->help('Шалгаруулалтын дахин давтагдашгүй дугаар')
                ->rules('required', 'max:255', 'unique:procurements,number,{{resourceId}}'),

            Text::make('Шалгаруулалтын нэр', 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Date::make('Зарласан огноо', 'start_date')
                ->sortable()
                ->rules('required'),

            Date::make('Дуусах огноо', 'end_date')
                ->sortable()
                ->rules('required'),

            Trix::make('Товч тайлбар', 'description')
                ->rules('required')
                ->alwaysShow(),

            Trix::make('Хавсаргах бичиг баримт', 'props->documents')
                ->alwaysShow(),

            Trix::make('Гэрээний нөхцөл', 'props->contract_term')
                ->alwaysShow(),

            Trix::make('Холбоо барих', 'props->sanamj')
                ->alwaysShow(),

            Trix::make('Шалгарсан компаний мэдээлэл', 'props->winner_info')
                ->alwaysShow(),

            Select::make(__('Status'), 'status')
                ->rules('required')
                ->options(\App\PublishStatus::statuses())
                ->displayUsingLabels(),

            BelongsTo::make('Бүртгэсэн', 'user', User::class)
                ->onlyOnDetail(),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Тендерийн урилга';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Тендерийн урилга';
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
