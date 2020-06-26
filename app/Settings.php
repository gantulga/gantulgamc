<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasTranslations;

    protected $primaryKey = 'key';
    protected $table = 'settings';
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = ['key', 'value'];
    protected $casts = ['value' => 'array'];
    public $translatable = ['value->app->name', 'value->contact->address'];

    public function get($key, $default)
    {
        return data_get($this->value, $key) ?? $default ?? null;
    }
}
