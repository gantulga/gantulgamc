<?php

namespace App\Http\View\Composers;

use App\Post;
use Carbon\Carbon;
use Illuminate\View\View;

class LatestNewsComposer
{
    /**
     * The user repository implementation.
     *
     * @var PostRepository
     */
    protected $posts;

    /**
     * Create a new profile composer.
     *
     * @param  PostRepository  $posts
     * @return void
     */
    public function __construct(/*PostRepository $posts*/)
    {
        /*
        $this->posts = collect([[
            'title' => 'Эрдэнэт бол зууны төдийгүй мянганы манлай бүтээн байгуулалт',
            'image_url' => 'img/news/news1.png',
            'created_at' => Carbon::now(),
        ],[
            'title' => 'Эрдэнэт бол зууны төдийгүй мянганы манлай бүтээн байгуулалт',
            'image_url' => 'img/news/news1.png',
            'created_at' => Carbon::now(),
        ],[
            'title' => 'Эрдэнэт бол зууны төдийгүй мянганы манлай бүтээн байгуулалт',
            'image_url' => 'img/news/news1.png',
            'created_at' => Carbon::now(),
        ],[
            'title' => 'Эрдэнэт бол зууны төдийгүй мянганы манлай бүтээн байгуулалт',
            'image_url' => 'img/news/news1.png',
            'created_at' => Carbon::now(),
        ],]);
        */
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('posts', Post::forFrontend()->limit(4)->get());
    }
}
