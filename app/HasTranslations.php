<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Exception;
use App\Scopes\TranslationScope;

trait HasTranslations
{
    //public $translatable = ['title', 'name', 'text', 'content'];

    public static function bootHasTranslations()
    {
        static::addGlobalScope(new TranslationScope);
        static::saved(function ($model) {
            $model->translation->translatable_id = $model->id;
            $model->translation->save();
        });
    }

    public function translation()
    {
        return $this->morphOne('App\Translation', 'translatable')->withDefault(['props' => ['locales' => []]]);
    }

    public function getAttributeValue($key)
    {
        if (
            $this->isDefaultLocale()
            || (!$this->isTranslatableAttribute($key)
                && !$this->isPartiallyTranslatableAttribute($key))
        ) {
            return parent::getAttributeValue($key);
        }

        $translation = $this->getTranslation($key, $this->getLocale());

        if ($this->isPartiallyTranslatableAttribute($key) && is_array($translation)) {
            $translation = $this->mergePartialTranslations(
                parent::getAttributeValue($key),
                $translation
            );
        }

        if ($this->hasGetMutator($key)) {
            return $this->mutateAttribute($key, $translation);
        }
        return $translation;
    }

    public function setAttribute($key, $value)
    {
        if (Str::startsWith($key, ['translation->props->locales->'])) {
            [,,, $locale, $key] = explode('->', $key, 5);
            $this->setTranslation($key, $locale, $value);
            return $this->setTranslation($key, $locale, $value);
        }

        if (
            $this->isDefaultLocale()
            || !$this->isTranslatableAttribute($key)
            || is_array($value)
        ) {
            return parent::setAttribute($key, $value);
        }

        // If the attribute is translatable and not already translated, set a
        // translation for the current app locale.
        return $this->setTranslation($key, $this->getLocale(), $value);
    }


    public function getTranslation($key, $locale)
    {
        return $this->translate($key, $locale);
    }

    public function translate(string $key, string $locale = '', $value = false)
    {
        $key = str_replace('->', '.', 'locales->' . $locale . '->' . $key);
        if ($value !== false) {
            $props = $this->translation->props;
            data_set($props, $key, $value);
            $this->translation->props = $props;
            //$this->translation->{$key} = $value;
        }
        return data_get($this->translation->props, $key, '');
    }

    public function setTranslation(string $key, string $locale, $value): self
    {
        $this->guardAgainstNonTranslatableAttribute($key);

        if ($this->hasSetMutator($key)) {
            $method = 'set' . Str::studly($key) . 'Attribute';

            $this->{$method}($value, $locale);

            $value = $this->attributes[$key];
        }

        $this->translate($key, $locale, $value);
        if ($this->timestamps) {
            $this->updateTimestamps();
        }

        return $this;
    }

    protected function mergePartialTranslations($value, $translation)
    {
        //return array_merge($value, $translation);
        return array_replace_recursive($value, $translation);
    }

    public function isPartiallyTranslatableAttribute(string $key): bool
    {
        return Arr::first($this->getTranslatableAttributes(), function ($attribute) use ($key) {
            return Str::startsWith($attribute, [$key . '->', $key . '.']);
        })
            ? true
            : false;
    }

    public function isTranslatableAttribute(string $key): bool
    {
        return in_array($key, $this->getTranslatableAttributes());
    }

    protected function guardAgainstNonTranslatableAttribute(string $key)
    {
        if (!$this->isTranslatableAttribute($key)) {
            throw new Exception("Cannot translate attribute `{$key}` as it's not one of the translatable attributes: `$this`");
        }
    }

    public function getTranslatableAttributes(): array
    {
        return is_array($this->translatable)
            ? $this->translatable
            : [];
    }

    protected function isDefaultLocale(): bool
    {
        //dd($this->getLocale(), app('laravellocalization')->getDefaultLocale());
        return $this->getDefaultLocale() == $this->getLocale();
    }

    protected function getLocale(): string
    {
        return Config::get('app.locale');
    }

    protected function getDefaultLocale(): string
    {
        return app('laravellocalization')->getDefaultLocale();
    }
}
