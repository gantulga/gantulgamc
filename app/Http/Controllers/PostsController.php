<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\PublishStatus;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index', [
            'posts'=>Post::forFrontend()->simplePaginate(config('app.page_size')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if($post->status != PublishStatus::PUBLISH){
            abort(404, 'Post not found.');
        }

        return view('post.show', [
            'post'=>$post,
            'category'=>$post->categories()->first(),
            'posts' => Post::forFrontend()->where('id','<>',$post->id)->limit(4)->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @param  mixed  $category
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request, $category)
    {
        if(is_numeric($category)){
            $category=Category::findOrFail($category);
        }
        elseif(is_string($category)){
            $category=Category::where('slug',$category)->firstOrFail();
        }

        return view('post.category', [
            'category' => $category,
            'posts'=>$category->posts()
                ->forFrontend()
                ->simplePaginate(config('app.page_size'))
        ]);
    }

    /**
     * Display search result.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $q = '%'.$request->q.'%';

        return view('post.search', [
            'q' => $request->q,
            'posts'=>Post::forFrontend()
                ->where('title','LIKE', $q)
                ->orWhere('props',"LIKE", $q)
                ->simplePaginate(config('app.page_size')),
        ]);
    }
}
