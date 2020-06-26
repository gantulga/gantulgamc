<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class FormEntry extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\FormEntry';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Маягт';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            BelongsTo::make(__('Form'), 'form', Form::class),
            DateTime::make(__('Created At'),'created_at')->exceptOnForms(),
            KeyValue::make(__('Attributes'),'attributes')
                ->keyLabel(__('Field'))
                ->displayUsing(function($attributes){
                    return array_reduce($this->form->fields, function($attr, $field) use ($attributes) {
                        $value = $attributes[$field['id']] ?? '';
                        $value = is_array($value) ? implode(', ', $value) : $value;
                        $attr[$field['label']] = $value;
                        return $attr;
                    }, []);
                }),
            Text::make(__('Attributes'), function(){
                $str = array_reduce($this->form->fields, function($str, $field) {
                    $value = $this->attributes[$field['id']] ?? '';
                    $value = is_array($value) ? implode(', ', $value) : $value;
                    return $str .'<b>'. $field['label'] .'</b>: '. $value . ', ';
                }, '');
                return '<div class="text-sm leading-loose">'.str_limit(trim($str.$str.$str, ", "), 200).'</div>';
            })->asHtml()->onlyOnIndex(),
        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Маягтын бичилтүүд';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Маягтын бичилт';
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
        return $query->with('form');
    }
}
