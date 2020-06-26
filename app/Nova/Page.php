<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

use Waynestate\Nova\CKEditor;
use Yassi\NestedForm\NestedForm;
use Qz\Editor\Editor;
use MrMonat\Translatable\Translatable;

use Erdenetmc\BelongsToParentField\BelongsToParentField;
use Erdenetmc\Wysiwyg\WysiwygField;
use Erdenetmc\MediaField\MediaField;

use App\Nova\HierarchicalTrait;


class Page extends Resource
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
    public static $group = 'Сайтын бүтэц';

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
        'id', 'title', 'slug'
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

            Text::make(__('Title'), 'title')
                ->sortable()
                ->rules('required', 'max:255')
                ->resolveUsing(function () {
                    return $this->title();
                }),
            Text::make(__('Title').' - en', 'translation->props->locales->en->title')
                ->hideFromIndex(),

            Text::make(__('Slug'), 'slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:pages,slug,NULL,id,deleted_at,NULL')
                ->updateRules('unique:pages,slug,{{resourceId}},id,deleted_at,NULL'),

            Select::make(__('Status'), 'status')
                ->options(\App\PublishStatus::statuses())
                ->displayUsingLabels()
                ->rules('required')
            //->withMeta(["value" => \App\PublishStatus::DRAFT])
            ,

            BelongsToParentField::make(__('Parent Page'), 'parent', Page::class)
                ->hideFromIndex()
                ->nullable(),

            MediaField::make(__('Image'), 'featuredImage')
                ->mimeType('image')
                ->diskPath(asset('img/') . '/')
                ->resolveUsing(function ($media) {
                    $media->each(function ($medium) {
                        $medium->file .= '?w=270&h=180&fit=crop';
                    });
                    return $media;
                }),

            Select::make(__('Template'), 'props->template')
                ->options($this->getTemplates())
                ->hideFromIndex(),

            //BelongsTo::make("Props.Category", 'props->category', Category::class)

            //Trix::make('Content'),
            /*
                NestedForm::make('Content Blocks', 'contentBlocks')
                ->open('only first')
                ->heading('{{index}} - {{type}}')
                ->max(100)
                ->beforeFill(function ($request, $model, $attribute, $requestAttribute) {
                    $request->merge(['contentable_type' => 'App\\Page']);
                })
                ,
                /*

                HasMany::make('Content Blocks', 'contentBlocks')
                */

            new Panel(__('Content'), [
                //Trix::make('Content', 'props->content'),
                //CKEditor::make('Content', 'content'),
                //GutenbergField::make('Content'),

                WysiwygField::make(__('Content'), 'props->blocks')
                    ->diskPath(asset('img/') . '/')
                    ->customBlockViews([
                        'includes.medee' => 'Мэдээ',
                        'includes.ajliin-bair' => 'Ажлын байр',
                        'includes.hudaldan-avalt' => 'Худалдан авалт',
                        'includes.virtual-tour' => 'Virtual tour',
                        'includes.durem-juram' => 'Дүрэм журам',
                    ])
                    ->forms(\App\Form::published()->get()->map(function ($form) {
                        return [
                            'id'=>$form->id,
                            'title'=>$form->title,
                        ];
                    }))
                    ->ckeditorConfig([
                        //'filebrowserBrowseUrl'=> '/cp/modal/resources/media',
                        'height' => 450,
                    ]),

                /*Editor::make('Content','props->content')*/
            ]),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Pages');
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Page');
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

    private function getTemplates()
    {
        $dir = 'page/';
        $files = File::files(resource_path('views/' . $dir));

        $views = array_reduce($files, function ($views, $file) use ($dir) {
            $basename = basename($file->getFilename(), '.blade.php');
            $views[$dir . $basename] = $basename;
            return $views;
        }, []);

        return $views;
    }
}
