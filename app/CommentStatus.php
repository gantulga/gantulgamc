<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class CommentStatus
{
    public const APPROVED = 'approved';
    public const PENDING = 'pending';
    public const SPAM = 'spam';

    public static function statuses(){
        return [
            self::APPROVED => __('Approved'),
            self::PENDING => __('Pending'),
            self::SPAM => __('Spam'),
        ];
    }
}
