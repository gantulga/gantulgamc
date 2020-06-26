<?php

namespace App\Observers;

trait HasParentPathObservantTrait
{
    public static function bootHasParentPathObservantTrait()
    {
        static::observe(HasParentPathObserver::class);
    }
}
