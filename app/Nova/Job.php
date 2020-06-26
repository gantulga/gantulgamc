<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Waynestate\Nova\CKEditor;

class Job extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Job';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Хүний нөөц';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'position';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'position',
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
            Text::make('Ажлын байр', 'position')
                ->sortable()
                ->rules('required')
                ->withMeta(['class' => 'w-full']),

            Trix::make('Тавигдах шаардлага', 'description')
                //CKEditor::make('Тавигдах шаардлага', 'description')
                ->rules('required'),

            Trix::make('Яаж бүртгүүлэх вэ?', 'props->how_to_apply')
                ->rules('required'),

            DateTime::make('Бүртгэл эхлэх хугацаа', 'starts_at')
                ->nullable()
                ->hideFromIndex(),

            DateTime::make('Бүртгэл дуусах хугацаа', 'expires_at')
                ->nullable()
                ->hideFromIndex(),

            Number::make('Орон тоо', 'count')
                ->rules('required')
                ->withMeta(["value" => 1]),

            Select::make('Төрөл', 'type')
                ->options(\App\Job::types()),

            Select::make(__('Status'), 'status')
                //->rules('required')
                ->options(\App\PublishStatus::statuses())
                ->displayUsingLabels(),

            HasMany::make('Анкетууд', 'applications', JobApplication::class),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Ажлын байрууд';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Ажлын байр';
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
