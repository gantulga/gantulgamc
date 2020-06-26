<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\ID;
//use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\MorphToMany;
use App\Nova\Fields\MediaFile;

class Media extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Media';

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
    public static $title = 'original_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'file', 'original_name', 'description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $disk = 'public';

        return [
            //ID::make()->sortable(),

            MediaFile::make(__('File'), 'file')
                ->prunable()
                ->creationRules('required')
                ->hideWhenUpdating()
                ->multiple(true)
                ->thumbnail(function () use ($disk) {
                    return $this->fileThumbnailUrl($disk);
                })
                ->preview(function () use ($disk) {
                    return $this->fileThumbnailUrl($disk);
                })
                ->help('Нэг зэрэг олон файл хуулж болно.'),

            Text::make(__('Name'), 'original_name')
                ->exceptOnForms()
                ->sortable(),

            Text::make(__('Path'), function () use ($disk) {
                return Storage::disk($disk)->url($this->file);
            })
                ->asHtml()
                ->onlyOnDetail(),

            Text::make(__('Size'), 'size')
                ->exceptOnForms()
                ->displayUsing(function ($value) {
                    return number_format($value / 1024, 2).'kb';
                }),

            Trix::make(__('Description'), 'description')
                ->alwaysShow(),

            //MediaTool::make(),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Медиа';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Медиа';
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

    private function fileThumbnailUrl($disk)
    {
        return \fileThumbnailUrl($this->file, $disk, $this->mime_type);
        /*
        if (starts_with($this->mime_type, 'image/')) {

            return $this->file ? Storage::disk($disk)->url($this->file.'?'.$size) : null;
        }
        $ext = pathinfo($this->file, PATHINFO_EXTENSION);
        $ext = in_array($ext, ['docx', 'pptx']) ? $ext.'_win' : $ext;
        return 'https://cdn0.iconfinder.com/data/icons/FileTypesIcons/128/'.$ext.'.png';
        */
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
        if ($request->mimeType) {
            $query->where('mime_type', 'like', $request->mimeType.'%');
        }
        return $query;
    }

    /**
     * Return the location to redirect the user after creation.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \App\Nova\Resource $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey(); //'/'.$resource->getKey();
    }
}
