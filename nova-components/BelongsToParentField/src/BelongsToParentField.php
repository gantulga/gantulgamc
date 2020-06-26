<?php

namespace Erdenetmc\BelongsToParentField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class BelongsToParentField extends BelongsTo
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'belongs-to-parent-field';

    /**
     * Build an associatable query for the field.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  bool  $withTrashed
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function buildAssociatableQuery(NovaRequest $request, $withTrashed = false)
    {
        $query = parent::buildAssociatableQuery($request, $withTrashed);

        $model = forward_static_call(
            [$resourceClass = $this->resourceClass, 'newModel']
        );

        if($request->resourceId) {
            $currentModel = $model::findOrFail($request->resourceId);
            $query->where('path', 'NOT LIKE', $currentModel->path.'%');
        }
        return $query;
    }
}
