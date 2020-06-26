<?php

namespace App\Nova;

use Illuminate\Http\Request;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Boolean;

use Erdenetmc\Wysiwyg\WysiwygField;
use Erdenetmc\MediaField\MediaField;
use Erdenetmc\BelongsToManyCheckbox\BelongsToManyCheckbox;
use Mdixon18\Fontawesome\Fontawesome;

class Post extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Post';

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
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','title'
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

            Text::make(__('Title'), 'title')
                ->sortable()
                ->rules('required', 'max:255'),

            Select::make(__('Status'), 'status')
                ->options(\App\PublishStatus::statuses())
                ->displayUsingLabels(),

            BelongsToManyCheckbox::make(__('Categories'), 'categories', Category::class)
                ->nullable(),

            MediaField::make(__('Image'), 'featuredImage')
                ->mimeType('image'),

            Boolean::make(__('Commentable'), 'props->commentable')
                ->hideFromIndex()
                ->withMeta(['value'=> $this->commentable])
                ->help('Коммент үлдээх боломжтой эсэх'),

            Fontawesome::make(__('Icon'), 'props->icon')
                ->hideFromIndex()
                ->only(['image','images','camera','youtube','facebook','twitter','video','chart-bar','file','volume-up','poll','poll-h',]),
                /*'file-alt','file-word','file-pdf','file-excel','file-powerpoint','file-image','file-video','file-audio','file-download','download', 'volume-down','desktop', 'pdf','word','excel'*/

            DateTime::make(__('Created At'), 'created_at')
                ->rules('required')
                ->sortable()
                ->firstDayOfWeek(1)
                ->withMeta([
                    'placeholder' => 'Select created date time',
                ]),
                //->exceptOnForms(),

            new Panel(__('Content'), [
                WysiwygField::make('Content', 'props->blocks')
                    ->withMeta([
                        'diskPath' => asset('img/').'/',
                    ])
                    ->forms(\App\Form::published()->get()->map(function ($form) {
                        return [
                            'id'=>$form->id,
                            'title'=>$form->title,
                        ];
                    }))
            ]),

            BelongsToMany::make('Холбоотой мэдээ', 'relatedPosts',  Post::class)
                ->searchable(),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Posts');
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Post');
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

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        if('posts' == $request->resource){
            //dd($request->resource, $request->resourceId);
            return $query->where('id', '!=', $request->resourceId);
        }
        return parent::relatableQuery($request, $query);
    }
}
