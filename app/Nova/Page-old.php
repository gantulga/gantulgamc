<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Image;

use Qz\BlockField\BlockField;
use Waynestate\Nova\CKEditor;
use Fourstacks\NovaRepeatableFields\Repeater;

use Erdenetmc\BelongsToParentField\BelongsToParentField;
use Erdenetmc\Wysiwyg\WysiwygField;
use Erdenetmc\MediaField\MediaField;

use App\Nova\HierarchicalTrait;

class PageOld extends Resource
{
    use HierarchicalTrait;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Page';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Content';

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
        'id','title','slug'
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['featuredImage'];

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

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Title', function () {
                return $this->title();
            })->onlyOnIndex()
                ->asHtml(),

            Text::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:pages,slug')
                ->updateRules('unique:pages,slug,{{resourceId}}'),

            Select::make('Status')->options(\App\PublishStatus::STATUSES),

            BelongsToParentField::make('Parent', 'parent', Page::class)
                ->hideFromIndex()
                ->nullable(),

            MediaField::make('Featured Image', 'featuredImage')
                ->mimeType('image')
                ->withMeta([
                    'diskPath' => asset('img/').'/',
                ])
                ->resolveUsing(function ($media) {
                    $media->each(function ($medium) {
                        $medium->file .= '?w=270&h=180&fit=crop';
                    });
                    return $media;
                }),

            new Panel('Content', [
                //CKEditor::make('Content', 'content')
                    //->hideFromIndex(),
                //Trix::make('Content')->withFiles('public'),
                //WysiwygField::make('Content', 'props->content')
                //    ->rules('required')
                //    ->help('This is help text'),
                //Markdown::make('Content'),
                /*
                Repeater::make('Content', 'props->content')
                    ->addField([
                        // configuation options
                        'label' => 'Text',
                        'type' => 'textarea',
                    ])
                    ->addField([
                        // configuation options
                        'label' => 'Class',
                        'type' => 'text',
                    ])
                */
                BlockField::make('Content', 'props->content')
                    ->addBlockType('Text', [
                        Trix::make('Content'),
                        Text::make('Class'),
                    ])
                    ->addBlockType('Image', [
                        MediaField::make('Image')
                            ->mimeType('image'),
                        Text::make('Caption'),
                    ])
                    ->addBlockType('Tabs', [
                        BlockField::make('Items')
                            ->addOnlyBlockType('Tab', [
                                Text::make('Name'),
                                BlockField::make('Items')
                                    ,
                            ])
                    ])
                    ->addBlockType('Carousel', [
                        BlockField::make('Items')
                            ->addOnlyBlockType('Slide', [
                                MediaField::make('Image')
                                    ->mimeType('image'),
                                Trix::make('Caption'),
                                Text::make('Link'),
                            ])
                    ])
                    ->defaultBlock('Text'),
                /*
                    [{
                        type: 'text',
                        content: 'asdfadf',
                        class: ''

                    },{
                        type: 'image',
                        caption: 'asjdf;kasdf;'
                    },{
                        type: 'tabs',
                        title: 'asdfadf'
                        items: [{
                            type
                        }]
                    }]

                */

            ]),

            //HasMany::make('Children','children',Page::class)
        ];
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
        return [new Actions\SetFeaturedImage];
    }
}
