<?php

namespace App\Http\View\Composers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Job;

class JobsComposer
{
    /**
     * The user repository implementation.
     *
     * @var JobRepository
     */
    protected $jobs;

    /**
     * Create a new profile composer.
     *
     * @param  JobRepository  $jobs
     * @return void
     */
    public function __construct(/*JobRepository $jobs*/)
    {
        $query = Job::published()->notExpired();
        $this->jobs = $query->latest()->limit(3)->get();
        $this->count = $query->count();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'jobs' => $this->jobs,
            'count' => $this->count,
        ]);
    }
}
