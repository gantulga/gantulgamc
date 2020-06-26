<?php

namespace App\Nova\Flexible\Resolvers;

use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class FormFieldsResolver implements ResolverInterface
{
    /**
     * get the field's value
     *
     * @param  mixed  $resource
     * @param  string $attribute
     * @param  Whitecube\NovaFlexibleContent\Layouts\Collection $layouts
     * @return Illuminate\Support\Collection
     */
    public function get($resource, $attribute, $layouts)
    {
        return collect($resource->fields)->map(function ($field) use ($layouts) {

            $layout = $layouts->find($field['type']);

            if (!$layout) return;

            return $layout->duplicateAndHydrate($field['id'], tap($field, function ($field) {
                unset($field['id'], $field['type']);
            }));

        })->filter();
    }

    /**
     * Set the field's value
     *
     * @param  mixed  $model
     * @param  string $attribute
     * @param  Illuminate\Support\Collection $groups
     * @return void
     */
    public function set($model, $attribute, $groups)
    {
        $model->fields = $groups->map(function ($group) {
            $attr = $group->getAttributes();
            if(isset($attr['options']) && is_string($attr['options']) ){
                $attr['options'] = json_decode($attr['options']);
            }
            return array_merge([
                'id' => $group->key(),
                'type' => $group->name(),
            ], $attr);
        });
    }
}
