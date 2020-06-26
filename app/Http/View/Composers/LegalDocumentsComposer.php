<?php

namespace App\Http\View\Composers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\LegalDocument;

class LegalDocumentsComposer
{
    /**
     * The user repository implementation.
     *
     * @var LegalDocumentRepository
     */
    protected $documents;

    /**
     * Create a new procurement composer.
     *
     * @param  LegalDocumentRepository  $documents
     * @return void
     */
    public function __construct(/*LegalDocumentRepository $documents*/)
    {
        $this->documents = LegalDocument::published()->latest()->limit(6)->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('documents', $this->documents);
    }
}
