<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\HasAuthorObservantTrait;

class Form extends Model
{
    use SoftDeletes,
        HasAuthorObservantTrait,
        HasPublishStatusTrait;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fields' => 'array',
        'settings' => 'array',
    ];

    public function entries()
    {
        return $this->hasMany(FormEntry::class);
    }

    public function getSettingsAttribute($val)
    {
        return array_merge([
            'stacked' => true,
            'submit_text' => 'Илгээх',
            'submit_text_processing' => 'Илгээж байна...',
            'success_message' => 'Баярлалаа. Маягт бүртгэгдлээ.'
        ], json_decode($val, true) ?? []);
    }
}
