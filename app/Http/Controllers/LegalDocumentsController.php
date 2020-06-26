<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LegalDocument;
use App\LegalDocumentCategory;

class LegalDocumentsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = LegalDocument::published()/*->notExpired()*/;

        return view('legal-document.index', [
            'categories' => $this->getCategories(),
            'documents'=> $query->simplePaginate(config('app.page_size')),
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
        $document = LegalDocument::published()->findOrFail($id);

        return view('legal-document.show', [
            'categories' => $this->getCategories(),
            'document'=>$document
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
            $category=LegalDocumentCategory::findOrFail($category);
        }
        elseif(is_string($category)){
            $category=LegalDocumentCategory::where('slug',$category)->firstOrFail();
        }

        return view('legal-document.index', [
            'category' => $category,
            'categories' => $this->getCategories(),
            'documents'=>$category->documents()
                ->simplePaginate(config('app.page_size'))
        ]);
    }

    private function getCategories()
    {
        return LegalDocumentCategory::orderBy('path')->get();
    }
}
