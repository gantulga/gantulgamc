<?php

namespace App\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;

trait HierarchicalTrait
{

    private static $hierarchicalTitle = false;

     /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        self::$hierarchicalTitle = true;
        $query->getQuery()->orders = [];
        return $query->orderBy('path');
    }

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        $pre = '';
        if(self::$hierarchicalTitle){
            //for($i=2; $i < count(explode('/',$this->path)); $i++){
            for($i=1; $i < (strlen($this->path))/4; $i++){
                $pre .= '— '; //'&nbsp;&nbsp;&nbsp;'; //—
            }
        }

        return $pre . $this->{self::$title};
    }

}
