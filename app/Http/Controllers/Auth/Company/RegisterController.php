<?php

namespace App\Http\Controllers\Auth\Company;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest:company');
    }

    /**
     * Get a guard instance by name.
     *
     * @param  string|null  $name
     * @return mixed
     */
    public function guard()
    {
        return \Auth::guard('company');
    }

    /**
     * Where to redirect users after registration.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('company.home');
    }

    /**
     * Show the company registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('company.register', [
            'countries'=>Company::countries(),
            'hariyalal'=>Company::hariyalal(),
            'ownershipForms' => Company::ownershipForms(),
            'activityCategories' => Company::activityCategories(),
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'name_eng' => 'required',
            'about' => 'required',
            'activities' => 'required',
            'country' => 'required',
            'props->hariyalal' => 'required',
            'reg_num' => 'required', //10 orontoi too
            'address' => 'required',
            'est_year' => 'required|date_format:Y|integer|max:'.date('Y'),
            'tax_num' => 'required',
            'props->tax_certificate' => 'required|file|mimes:jpeg,bmp,png,pdf,doc,docx',
            'vat_num' => 'required',
            'props->cooperation_direction' => 'required',
            'activity_category' => 'required',
            'ownership_form' => 'required',
            //'props->audit_report' => 'required',
            'employee_count' => 'required',
            'props->dealer_distributer' => 'required',
            'customers' => 'required',
            'props->dir_image' => 'required|image',
            'dir_name' => 'required',
            'dir_pos' => 'required',
            'dir_mobile' => 'required',
            'dir_email' => 'required',
            'dir_fax' => 'required',
            'props->contact_image' => 'required|image',
            'contact_name' => 'required',
            'contact_pos' => 'required',
            'contact_mobile' => 'required',
            'contact_email' => 'required|unique:companies',
            'contact_fax' => 'required',
            'props->questions' => 'required',
            'terms-of-service' => 'accepted',
        ], [
            'required' => 'Талбарыг бөглөх шаардлагатай.',
            'image' => 'Зураган файл байх шаардлагатай.',
            'file' => 'Файл upload хийх ёстой.',
            'mimes' => 'Файлын төрөл :values байх ёстой.',
        ]);
    }

    /**
     * Create a new company instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Company
     */
    protected function create(array $data)
    {
        $company = new Company($data);
        //$company['props->tax_certificate'] = $data['props->tax_certificate']->storeAs('/company\/'.$company->id, 'props->tax_certificate.'.$data['props->tax_certificate']->extension(), 'public');
        $disk = 'public';
        $company->storeFile('props->tax_certificate', request(), $disk);
        $company->storeFile('props->dir_image', request(), $disk);
        $company->storeFile('props->contact_image', request(), $disk);
        $company->save();
        return $company;
    }
}
