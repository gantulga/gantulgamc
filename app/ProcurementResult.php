<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\HasAuthorObservantTrait;

class ProcurementResult extends Model
{
    use SoftDeletes;
    use HasAuthorObservantTrait;
    use HasPublishStatusTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
