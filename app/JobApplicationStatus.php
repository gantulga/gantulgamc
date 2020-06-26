<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class JobApplicationStatus
{
    public const REVIEWED = 'reviewed';
    public const PENDING = 'pending';
    public const SPAM = 'spam';

    public static function statuses(){
        return [
            self::REVIEWED => __('Reviewed'),
            self::PENDING => __('Pending'),
            self::SPAM => __('Spam'),
        ];
    }
}
