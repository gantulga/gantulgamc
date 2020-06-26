<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Image;

use Erdenetmc\BelongsToManyCheckbox\BelongsToManyCheckbox;

class LegalDocument extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\LegalDocument';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Хууль дүрэм';

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
        'id', 'name'
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

            Text::make('Нэр','name')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsToManyCheckbox::make('Ангилал', 'categories', LegalDocumentCategory::class)
                ->nullable(),

            Trix::make('Тайлбар', 'description')
                ->alwaysShow(),

            Image::make('Файл','file')
                ->prunable()
                ->rules('file', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,bmp,png')
                ->creationRules('required')
                ->disk('public')

                ->thumbnail(function () {
                    return fileThumbnailUrl($this->file);
                })
                ->preview(function () {
                    return fileThumbnailUrl($this->file);
                })

                ->store(function (Request $request, $model){
                    return [
                        'file' => $request->file->store('/legal-documents', 'public'),
                        'file_name' => $request->file->getClientOriginalName(),
                    ];
                }),

            Select::make(__('Status'), 'status')
                ->rules('required')
                ->options(\App\PublishStatus::statuses())
                ->displayUsingLabels(),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'ХЗ бичиг баримтууд';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'ХЗ бичиг баримт';
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
