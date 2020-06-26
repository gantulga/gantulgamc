<?php

namespace Erdenetmc\BelongsToManyCheckbox;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class BelongsToManyCheckbox extends BelongsTo
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'belongs-to-many-checkbox';

    /**
     * Resolve the field's value.
     *
     * @param  mixed  $resource
     * @param  string|null  $attribute
     * @return void
     */

    public function resolve($resource, $attribute = null)
    {
        $this->value = $resource->{$this->attribute}()->withoutGlobalScopes()->get()->map(function($model){
            return [
                'value' => $model->getKey(),
                'display' => $this->formatDisplayValue($model),
            ];
        });
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  object  $model
     * @return void
     */
    public function fill(NovaRequest $request, $model)
    {
        $this->fillInto($request, $model, $this->attribute);

        if ($this->filledCallback) {
            call_user_func($this->filledCallback, $request, $model);
        }
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if (!$request->exists($requestAttribute)) {
            return;
        }

        $ids = $request->get($requestAttribute,[]);

        $model->saved(function($model) use ($attribute, $ids){
            $model->{$attribute}()->sync($ids);
        });
    }
}
