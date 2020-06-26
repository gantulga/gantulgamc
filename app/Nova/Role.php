<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\MorphMany;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

//use Fourstacks\NovaCheckboxes\Checkboxes;
use Silvanite\NovaFieldCheckboxes\Checkboxes;


class Role extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Role';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Хэрэглэгчийн эрх';

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
        'name',
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

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Heading::make('Хандах эрхүүд'),

            $this->getPermissionFields($request),

            BelongsToMany::make(__('Users'), 'users', User::class),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Үүргүүд';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Хэрэглэгчийн үүрэг';
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function longLabel()
    {
        return 'Хэрэглэгчийн үүргүүд';
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
     * Get the all resources.
     *
     * @return array
     */
    public static function getResources()
    {
        $resources = array_diff(\Nova::$resources, [
            'Laravel\Nova\Actions\ActionResource',
            'App\Nova\MenuItem',
        ]);

        return $resources;
    }

    private function getPermissionFields($request)
    {
        $fields = [];
        /*
        $groups = collect(self::getResources())->groupBy(function ($item, $key) {
            return $item::group();
        })->sortKeys();

        foreach ($groups as $group => $resources) {

            $options = $resources->flatMap(function($res){
                return [$res::$model =>  $res::longLabel()];
            })->toArray();

            $fields[] = Checkboxes::make($group, 'permissions')
                ->options($options);
        }
        */

        $options = collect(self::getResources())->flatMap(function($res){
            return [$res::$model =>  $res::longLabel()];
        })->toArray();

        $fields[] = Checkboxes::make('Хандах эрх', 'permissions')
            ->options($options);

        return $this->merge($fields);
    }
}
