<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class PublishStatus
{
    public const DRAFT = 'draft';
    public const PUBLISH = 'publish';
    public const EXPIRE = 'expire';

    public static function statuses(){
        return [
            self::DRAFT => __('Draft'),
            self::PUBLISH => __('Published'),
            self::EXPIRE => __('Expired'),
        ];
    }
}
