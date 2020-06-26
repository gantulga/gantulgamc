<?php

namespace App\Nova\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Controllers\AssociatableController as AssociatableControllerBase;

class AssociatableController extends AssociatableControllerBase
{
    /**
     * List the available related resources for a given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(NovaRequest $request)
    {
        $field = $request->newResource()
                    ->availableFields($request)
                    ->firstWhere('attribute', $request->field);

        $withTrashed = $this->shouldIncludeTrashed(
            $request, $associatedResource = $field->resourceClass
        );

        return [
            'resources' => $field->buildAssociatableQuery($request, $withTrashed)->get()
                        ->mapInto($field->resourceClass)
                        ->filter->authorizedToAdd($request, $request->model())
                        ->map(function ($resource) use ($request, $field) {
                            return $field->formatAssociatableResource($request, $resource);
                        // remove sort by display
                        })/*->sortBy('display')*/->values(),
            'softDeletes' => $associatedResource::softDeletes(),
            'withTrashed' => $withTrashed,
        ];
    }

}
