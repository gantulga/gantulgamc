<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Post extends Model implements Feedable
{
    use Searchable;
    use SoftDeletes;
    use PostTrait {
        PostTrait::toSearchableArray insteadof Searchable;
        PostTrait::shouldBeSearchable insteadof Searchable;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'props' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeForFrontend($query)
    {
        return $query->latest()
            ->published()
            ->with(['categories', 'featuredImage']);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCommentableAttribute()
    {
        return $this->props['commentable'] ?? true;
    }

    public function relatedPosts()
    {
        return $this->belongsToMany(Post::class, 'related_posts', 'post_id', 'related_id');
    }

    public static function getFeedItems()
    {
        return static::forFrontend()->with(['user'])->limit(100)->get();
    }

    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->getLink(false))
            ->title($this->title)
            ->summary($this->getSummary())
            ->updated($this->updated_at)
            ->link($this->getLink())
            ->author($this->author)
            ->category($this->getCategoryNames());
    }

    private function getSummary()
    {
        if (isset($this->props['summary'])) {
            return $this->props['summary'];
        } else {
            return Str::words($this->getTextContent(), 200);
        }
    }

    private function getCategoryNames()
    {
        return $this->categories->implode('name', ', ');
    }

    public function getLink($absolute = true)
    {
        return route('post.show', ['post' => $this->id], $absolute);
    }
}
