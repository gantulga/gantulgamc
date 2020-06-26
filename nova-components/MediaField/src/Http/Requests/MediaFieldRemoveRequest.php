<?php

namespace Erdenetmc\MediaField\Http\Requests;

use Laravel\Nova\Http\Requests\PivotFieldDestroyRequest;
use Laravel\Nova\Nova;
use Erdenetmc\MediaField\MediaField;

class MediaFieldRemoveRequest extends PivotFieldDestroyRequest
{

    /**
     * Find the field of media being removed or fail if it is not found.
     *
     * @return \Laravel\Nova\Fields\Field
     */
    public function findFieldOrFail()
    {
        return $this->findResourceOrFail()->resolveFieldForAttribute($this, $this->field);
            /*
            ->whereInstanceOf(MediaField::class)
            ->findFieldByAttribute($this->field, function () {
                abort(404);
            });
            */
    }
}
