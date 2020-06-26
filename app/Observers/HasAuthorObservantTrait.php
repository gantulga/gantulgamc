<?php

namespace App\Observers;

trait HasAuthorObservantTrait
{
    public static function bootHasAuthorObservantTrait()
    {
        static::observe(HasAuthorObserver::class);
    }
}
