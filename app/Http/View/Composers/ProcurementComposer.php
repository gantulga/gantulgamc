<?php

namespace App\Http\View\Composers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Procurement;

class ProcurementComposer
{
    /**
     * The user repository implementation.
     *
     * @var ProcurementRepository
     */
    protected $procurements;

    /**
     * Create a new procurement composer.
     *
     * @param  ProcurementRepository  $procurements
     * @return void
     */
    public function __construct(/*ProcurementRepository $procurements*/)
    {
        $this->procurements = Procurement::/*active()->*/published()->latest()->limit(config('app.home_procurement_size'))->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('procurements', $this->procurements);
    }
}
