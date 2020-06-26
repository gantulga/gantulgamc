<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HasParentPathObserver
{
    /**
     * Handle the model "saved" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function saved(Model $model)
    {
        $this->updatePath($model);
    }

    /**
     * Helper function for updating model path
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    private function updatePath(Model $model)
    {
        $old_path = $model->path;
        //LPAD(str, len, padstr)
        //CONV(num , from_base , to_base );
        //
        //$new_path =  $model->id . '/';
        $new_path = str_pad(base_convert($model->id, 10, 36), 4, '0', STR_PAD_LEFT);
        if($model->parent){
            $new_path = $model->parent->path . $new_path;
        }

        if($new_path == $old_path){
            return;
        }
        if($old_path){
            // update all descendants paths
            $model->where('path', 'like', $old_path . '%')
                ->update(['path' => DB::raw( "REPLACE(path, '".$old_path."', '".$new_path."')" )]);
        }
        else {
            // model is new
            $model->where('id',$model->id)->update(['path'=>$new_path]);
        }
    }
}
