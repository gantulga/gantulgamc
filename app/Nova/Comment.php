<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class Comment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Comment';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Мэдээ';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'text';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'text'
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

            Text::make(__('Name'), function () {
                    return $this->user->name ?? $this->name;
                })
                ->exceptOnForms(),

            Text::make(__('Name'), 'name')
                ->onlyOnForms(),

            BelongsTo::make(__('User'), 'user', User::class)
                ->searchable()
                ->onlyOnForms(),

            tap(Textarea::make(__('Comment'), 'text')
                ->alwaysShow(),function($textarea){
                    $textarea->showOnIndex = true;
                }),

            BelongsTo::make(__('Post'), 'post', Post::class)
                ->searchable(),

            Select::make(__('Status'), 'status')
                ->options(\App\CommentStatus::statuses())
                ->displayUsingLabels(),


            DateTime::make(__('Created At'), 'created_at')
                ->sortable()
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
        return 'Комментууд';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Коммент';
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
        return [
            new Lenses\CommentsSpam,
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new Actions\CommentApprove,
            new Actions\CommentUnapprove,
            new Actions\CommentMarkAsSpam,
        ];
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->with('post','user')->notSpam();
    }
}
