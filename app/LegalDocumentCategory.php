<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\HasParentPathObservantTrait;

class LegalDocumentCategory extends Model
{
    use SoftDeletes;
    use HasParentPathObservantTrait;

    public function parent()
    {
        return $this->belongsTo(LegalDocumentCategory::class, 'parent_id');
    }

    public function documents()
    {
        return $this->belongsToMany(LegalDocument::class, 'legal_document_category_pivot', 'category_id', 'document_id');
    }
}
