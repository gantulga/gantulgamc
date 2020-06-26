<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\HasAuthorObservantTrait;

class LegalDocument extends Model
{
    use SoftDeletes;
    use HasAuthorObservantTrait;
    use HasPublishStatusTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(LegalDocumentCategory::class, 'legal_document_category_pivot',  'document_id', 'category_id');
    }

    public function scopePublished($query)
    {
        return $query->whereStatus(PublishStatus::PUBLISH);
    }

}
