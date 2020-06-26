<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['props'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'props' => 'array',
    ];

    public function allItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function items()
    {
        return $this->allItems()->whereNull('parent_id')->orderBy('order');
    }

    public function clone()
    {
        return \DB::transaction(function () {

            $replica = $this->replicate();
            $replica->name = $this->name.' New';
            $replica->slug = $this->slug.'-new';
            $replica->save();

            function cloneItems($menu_id, $items, $parent=null){
                foreach($items as $item){
                    $replicaItem = $item->replicate();
                    $replicaItem->menu_id = $menu_id;
                    $replicaItem->path = '';
                    if($parent) $replicaItem->parent_id = $parent->id;
                    $replicaItem->save();
                    cloneItems($menu_id, $item->items, $replicaItem);
                }
            };

            cloneItems($replica->id, $this->items);
        });
    }

}
