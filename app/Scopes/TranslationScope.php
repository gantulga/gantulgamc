<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;


class TranslationScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if($this->isDefaultLocale()){
            return;
        }

        //$builder->where('age', '>', 200);
        $builder->whereHas('translation', function (Builder $query) {
            $query->whereNotNull('props->locales->'.$this->getLocale());
        });
    }

    protected function isDefaultLocale(): bool
    {
        return $this->getLocale() == app('laravellocalization')->getDefaultLocale();
    }


    protected function getLocale(): string
    {
        return Config::get('app.locale');
    }
}
