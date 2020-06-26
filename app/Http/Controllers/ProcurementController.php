<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procurement;
use App\ProcurementResult;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('procurement.index', [
            'procurements'=>Procurement::/*active()->*/published()->latest()->with('user')->simplePaginate(config('app.page_size')),
        ]);
    }

    /**
     * Display the listing of procurement bid results or specific results.
     *
     * @param  Request  $request
     * @param  ProcurementResult  $result
     * @return \Illuminate\Http\Response
     */
    public function results(Request $request, ProcurementResult $result)
    {
        if($result && $result->exists && $result->status != \App\PublishStatus::PUBLISH){
            abort('404');
        }

        return view('procurement.result', [
            'result' => $result,
            'results'=> $result->exists ? null : ProcurementResult::published()->latest()->simplePaginate(config('app.page_size')),
        ]);
    }

}
