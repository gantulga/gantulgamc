<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\HasAuthorObservantTrait;

trait PostTrait
{
    use MediableTrait;
    use HasAuthorObservantTrait;
    use HasPublishStatusTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function featuredImage()
    {
        return $this->media()->isImage()->wherePivot('collection', 'featuredImage'); //->limit(1);
    }

    public function getAuthorAttribute()
    {
        return $this->user->name;
    }

    public function getTextContent()
    {
        return isset($this->props['blocks'])
            ? $this->getBlockTexts($this->props['blocks'])
            : '';
    }

    private function getBlockTexts($blocks)
    {
        $text = '';

        try {
            foreach ($blocks as $block) {
                /*
                if ($block['type'] == 'Text' && isset($block['attributes']['content'])) {
                    $text .= strip_tags($block['attributes']['content']);
                }
                */
                //echo $block['type'] ?? '' . '\n';
                foreach (['content', 'title', 'text', 'caption', 'name'] as $attr) {
                    if (isset($block['attributes'][$attr])) {
                        $text .= ' ' . trim(strip_tags($block['attributes'][$attr]));
                    }
                }

                foreach (['blocks', 'columns', 'slides', 'tabs'] as $attr) {
                    if (isset($block[$attr]) && is_array($block[$attr])) {
                        $text .= ' ' . $this->getBlockTexts($block[$attr]);
                    }
                    if (isset($block['attributes'][$attr]) && is_array($block['attributes'][$attr])) {
                        $text .= ' ' . $this->getBlockTexts($block['attributes'][$attr]);
                    }
                }
            }
        } catch (\Exception $e) {
            return $text;
        }
        return $text;
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->getTextContent()
        ];
    }

    public function shouldBeSearchable()
    {
        return $this->isPublished();
    }
}
