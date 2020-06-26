<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\PublishStatus;

class JobsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Job::published()->latest()/*->notExpired()*/;

        return view('job.index', [
            'jobs'=> $query->simplePaginate(config('app.page_size')),
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
        $job = Job::findByIdBase36($id);

        if($job==null || $job->status != PublishStatus::PUBLISH){
            abort(404, 'Job not found.');
        }

        return view('job.show', [
            'job'=>$job
        ]);
    }
}
