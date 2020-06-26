<?php

namespace App\Http\Controllers;

use App\Page;
use App\PublishStatus;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  string  $slugPath
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slugPath='home')
    {
        $page = Page::findBySlugPath($slugPath);

        if($page==null || $page->status != PublishStatus::PUBLISH){
            abort(404, 'Page not found.');
        }

        return view($page->props['template'] ?? 'page.default', ['page'=>$page]);
    }


}
