<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class HasAuthorObserver
{
     /**
     * Handle the media "creating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        $this->setCurrentUserAsAuthor($model);
    }

    /**
     * Helper function for setting current user as author of the media
     *
     * @param  \AIlluminate\Database\Eloquent\Model  $model
     * @return void
     */
    private function setCurrentUserAsAuthor($model)
    {
        if(!isset($model->user_id))
            $model->user_id = auth()->id();
    }
}
