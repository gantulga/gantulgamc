<?php

namespace App\Http\Requests;

use App\Form;
use Illuminate\Foundation\Http\FormRequest;

class FormEntryRequest extends FormRequest
{
    protected $rules = [];
    protected $messages = [];

    public function __construct()
    { }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        foreach ($this->route('form')->fields as $field) {
            $rule = [];
            if ($field['required']) {
                $rule[] = 'required';
                $this->messages[$field['id'] . '.required'] = $field['label'] . ' ' . __('field required');
            }
            if ($field['type'] == 'email') {
                $rule[] = 'email';
                $this->messages[$field['id'] . '.email'] = __('Not valid email address');
            }
            $this->rules[$field['id']] = implode('|', $rule);
        }
        return $this->rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return $this->messages;
    }
}
