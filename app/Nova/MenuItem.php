<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;

use Erdenetmc\BelongsToParentField\BelongsToParentField;

use App\Nova\HierarchicalTrait;

class MenuItem extends Resource
{
    use HierarchicalTrait;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\MenuItem';

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

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
        'id', 'name', 'url'
    ];

    /**
     * The number of resources to show per page via relationships.
     *
     * @var int
     */
    public static $perPageViaRelationship = 20;

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

            BelongsTo::make('Menu')
                ->onlyOnDetail(),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->resolveUsing(function () {
                    return $this->title();
                }),

            Text::make(__('Name') . ' - en', 'translation->props->locales->en->name')
                ->hideFromIndex(),

            Text::make(__('Url'), 'url')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsToParentField::make(__('Parent'), 'parent', MenuItem::class)
                ->hideFromIndex()
                ->nullable(),

            Number::make(__('Order'), 'order')
                ->sortable()
                ->rules('required'),

            Text::make(__('Css Class'), 'props->class')
                ->hideFromIndex(),

        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Links');
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Link');
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
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        self::$hierarchicalTitle = true;
        $query->getQuery()->orders = [];
        return $query->orderBy('path')->orderBy('order');
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
        $query = parent::relatableQuery($request, $query);

        if ($request->viaResource == 'menus' && $request->viaResourceId) {
            //dd($request->viaResourceId);
            $query->where('menu_id', $request->viaResourceId);
        }
        return $query;
    }
}
