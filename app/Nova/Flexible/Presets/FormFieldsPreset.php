<?php

namespace App\Nova\Flexible\Presets;

use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use NovaItemsField\Items;

class FormFieldsPreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field)
    {
        $fieldDef = [
            Text::make(__('Label'), 'label')->rules('required', 'max:255'),
            Text::make(__('Description'), 'desc'),
            Boolean::make(__('Required'), 'required'),
        ];
        $fieldDefWithOptions = $fieldDef;
        $fieldDefWithOptions[] = Items::make(__('Options'), 'options')->listFirst()->hideCreateButton();


        $field->resolver(\App\Nova\Flexible\Resolvers\FormFieldsResolver::class)
            ->addLayout(__('Text'), 'text', $fieldDef)
            ->addLayout(__('Textarea'), 'textarea', $fieldDef)
            ->addLayout(__('Email'), 'email', $fieldDef)
            ->addLayout(__('Select'), 'select', $fieldDefWithOptions)
            ->addLayout(__('Radio'), 'radio', $fieldDefWithOptions)
            ->addLayout(__('Checkbox'), 'checkbox', $fieldDefWithOptions)
            ->button(__('Add Field'))
            ->collapsed();
    }
}
