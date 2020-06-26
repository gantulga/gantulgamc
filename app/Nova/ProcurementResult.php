<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Date;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProcurementResult extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\ProcurementResult';

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
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title',
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
            ID::make()->sortable(),

            Text::make('Гарчиг', 'title')
                ->sortable()
                ->rules('required', 'max:255'),

            Trix::make('Товч тайлбар', 'description')
                ->rules('required')
                ->alwaysShow(),

            Image::make('Файл','attachment')
                ->prunable()
                ->rules('file', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,bmp,png')
                ->disk('public')
                ->thumbnail(function () {
                    return fileThumbnailUrl($this->attachment);
                })
                ->preview(function () {
                    return fileThumbnailUrl($this->attachment);
                })
                ->store(function (Request $request, $model){
                    return [
                        'attachment' => $request->attachment->store('/procurement/result', 'public'),
                        'attachment_name' => $request->attachment->getClientOriginalName(),
                    ];
                }),


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
        return 'Тендерийн үр дүн';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Тендерийн үр дүн';
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
