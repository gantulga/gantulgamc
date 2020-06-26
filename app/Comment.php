<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->whereStatus(CommentStatus::APPROVED);
    }

    public function scopePending($query)
    {
        return $query->whereStatus(CommentStatus::PENDING);
    }

    public function scopeSpam($query)
    {
        return $query->whereStatus(CommentStatus::SPAM);
    }

    public function scopeNotSpam($query)
    {
        return $query->where('status','<>',CommentStatus::SPAM);
    }
}
