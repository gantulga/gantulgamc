<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class SitemapController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('items.items')->whereSlug('sitemap')->first();

        return view('sitemap.index', [
            'menu'=> $menu,
        ]);
    }

}
