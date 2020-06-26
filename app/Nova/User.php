<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Panel;

use Erdenetmc\BelongsToManyCheckbox\BelongsToManyCheckbox;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\User';

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
        'id', 'name', 'email',
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
            ID::make()->sortable(),

            //Gravatar::make(),
            Avatar::make(__('Avatar'), 'avatar')
                ->disk('public')
                ->prunable()
                ->store(function (Request $request, $model) use ($disk) {
                    //return [
                    //    'avatar' => $request->avatar->store('/user/'.$model->id, $disk),
                    //];
                    $model->saved(function ($model) use ($request, $disk) {
                        if ($request->hasFile('avatar')) {
                            $path = '/user/'.$model->id.'/avatar';
                            $model->where('id', $model->id)->update([
                                'avatar' => $request['avatar']->store($path, $disk),
                            ]);
                        }
                    });
                }),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:6')
                ->updateRules('nullable', 'string', 'min:6'),

            new Panel('Холбоо барих', [
                Text::make('Утас', 'props->phone')->hideFromIndex(),
                Text::make('Албан тушаал', 'props->position')->hideFromIndex(),
                Text::make('Гар утас', 'props->phone')->hideFromIndex(),
                Text::make('Ажлын утас', 'props->office_phone')->hideFromIndex(),
                Textarea::make('Хаяг', 'props->address')->hideFromIndex(),
            ]),

            //BelongsToMany::make('Үүргүүд'),
            BelongsToManyCheckbox::make('Үүргүүд', 'roles', Role::class)->nullable(),

        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Хэрэглэгчид';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Хэрэглэгч';
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
