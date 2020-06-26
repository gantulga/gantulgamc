<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait HasPublishStatusTrait
{
    public function scopePublished($query)
    {
        return $query->whereStatus(PublishStatus::PUBLISH);
    }

    public function isPublished()
    {
        return $this->status === PublishStatus::PUBLISH;
    }
}
