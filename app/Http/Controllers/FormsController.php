<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormEntry;
use App\FormEntryStatus;
use App\PublishStatus;
use App\Http\Requests\FormEntryRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FormsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['form.check']);
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
        $form = is_numeric($id) ? Form::findOrFail($id) : Form::published()->whereName($id)->firstOrFail();

        $this->abortIfFormStatusIsNotPublished($request, $form);

        return view('form.show', ['form' => $form]);
    }

    /**
     * Post a form entry.
     *
     * @param  FormEntryRequest  $request
     * @param  Form $form
     * @return Redirect
     */
    public function post(FormEntryRequest $request, Form $form)
    {
        $this->abortIfFormStatusIsNotPublished($request, $form);
        // Create form entry
        $entry = new FormEntry;
        $entry->ip = $request->ip();
        $entry->request_data = (string)$request;
        $entry->status = FormEntryStatus::PENDING;
        $entry->attributes = array_reduce($form->fields, function($attr, $field) use ($request, $form) {
            $attr[$field['id']] = $request->{$field['id']} ;
            return $attr;
        }, []);

        if ($form->entries()->save($entry)) {
            return back()
                ->with('form-'.$form['name'].'-success', $form->settings['success_message'] ?? __('Form submitted with success'));
        }

        return back()->withInput();
    }

    private function abortIfFormStatusIsNotPublished(Request $request, Form $form)
    {
        if ($form->status !== PublishStatus::PUBLISH) {
            abort(404, __('Form not found.'));
        }
    }

}
