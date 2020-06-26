<?php

namespace App\Http\Controllers;

use App\Scout\Engines\MysqlEngine;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->q;

        if(!$search){
            return view('search.index');
        }

        $query = MysqlEngine::searchQuery($search);
        $count = (clone $query)->count();
        $results = $query->simplePaginate(config('app.page_size'));

        return view('search.index', ['search' => $search, 'results' => $results, 'count' => $count]);
    }
}
