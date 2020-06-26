<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
use App\Observers\HasParentPathObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;


class Page extends Model
{
    //use Actionable;
    use Searchable;
    use SoftDeletes;
    use HasParentPathObservantTrait;
    use PostTrait {
        PostTrait::toSearchableArray insteadof Searchable;
        PostTrait::shouldBeSearchable insteadof Searchable;
    }
    use HasTranslations;

    public $translatable = ['title'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['path'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'props' => 'array',
    ];

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function getSlugPath()
    {
        //$ids = explode('/', $this->path);
        $ids = array_map(function($id_b36){
            return \base_convert($id_b36, 36, 10);
        },str_split($this->path, 4));

        $ancestors = Page::orderBy('path')->find($ids);

        $slugPath = $ancestors->reduce(function ($path, $page) {
            return $path . $page->slug . '/';
        }, '');

        return rtrim($slugPath, '/');
    }

    public static function findBySlugPath($slugPath)
    {
        $slugArr = explode('/', $slugPath);

        $slug = array_pop($slugArr);

        $page = self::findBySlug($slug);

        if($page && $page->getSlugPath() != $slugPath){
            return null;
        }
        return $page;
    }

    public function getLink($absolute=true)
    {
        return route('page', ['slugPath' => $this->getSlugPath()], $absolute);
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->getTextContent(),
        ];
    }
}
