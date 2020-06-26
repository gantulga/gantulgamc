<?php

namespace Erdenetmc\MediaField\Http\Controllers;

use Laravel\Nova\DeleteField;
use Illuminate\Routing\Controller;
use Laravel\Nova\Actions\ActionEvent;
use Erdenetmc\MediaField\Http\Requests\MediaFieldRemoveRequest;

class RemoveController extends Controller
{
    /**
     * Delete the file at the given field.
     *
     * @param  \Erdenetmc\MediaField\Http\Requests\MediaFieldRemoveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(MediaFieldRemoveRequest $request)
    {
        $request->authorizeForAttachment();

        $result = DeleteField::forRequest(
            $request, $request->findFieldOrFail(), $request->findModelOrFail()
        );

        ActionEvent::forAttachedResourceUpdate(
            $request, $request->findModelOrFail(), $request->findPivotModel()
        )->save();

        return $result;
    }
}
