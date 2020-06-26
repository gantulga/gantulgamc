<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use Notifiable;

    protected $guard = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_eng',
        'about',
        'activities',
        'country',
        'reg_num',
        'tax_num',
        'vat_num',
        'address',
        'est_year',
        'activity_category',
        'ownership_form',
        'employee_count',
        'customers',
        'dir_pos',
        'dir_name',
        'dir_mobile',
        'dir_fax',
        'dir_email',
        'contact_name',
        'contact_pos',
        'contact_mobile',
        'contact_fax',
        'contact_email',
        'props',
        'props->hariyalal',
        'props->cooperation_direction',
        'props->dealer_distributer',
        'props->questions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'props' => 'array',
    ];

    public function reviews()
    {
        return $this->hasMany(CompanyReview::class);
    }

    public function storeFile($field, $request, $disk)
    {
        $this->saved(function ($model) use ($field, $request, $disk) {
            if ($request->hasFile($field)) {
                $path = '/company/'.$model->id.'/'.$field;
                $model->where('id', $model->id)->update([
                    $field => $request[$field]->store($path, $disk),
                ]);
            }
        });
    }

    public function getEmailAttribute()
    {
        return $this->contact_email;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new Notifications\CompanyVerifyEmail);
    }


    public static function countries()
    {
        $arr = ["Монгол", "Russia", "China", "Japan", "Korea", "Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Barbuda", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Trty.", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Caicos Islands", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Futuna Islands", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard", "Herzegovina", "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Jan Mayen Islands", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea", "Korea (Democratic)", "Kuwait", "Kyrgyzstan", "Lao", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "McDonald Islands", "Mexico", "Micronesia", "Miquelon", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Nevis", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Principe", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre", "Saint Vincent", "Samoa", "San Marino", "Sao Tome", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia", "South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "The Grenadines", "Timor-Leste", "Tobago", "Togo", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Turks Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "US Minor Outlying Islands", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (US)", "Wallis", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"];
        return array_combine($arr,$arr);
    }

    public static function hariyalal()
    {
        $arr = ["Багануур дүүрэг", "Багахангай дүүрэг", "Баянгол дүүрэг", "Баянзүрх дүүрэг", "Налайх дүүрэг", "Сонгинохайрхан дүүрэг", "Сүхбаатар дүүрэг", "Хан-Уул дүүрэг", "Чингэлтэй дүүрэг", "Архангай аймаг", "Баян-Өлгий аймаг", "Баянхонгор аймаг", "Булган аймаг", "Говь-Алтай аймаг", "Говьсүмбэр аймаг", "Дархан-Уул аймаг", "Дорноговь аймаг", "Дорнод аймаг", "Дундговь аймаг", "Завхан аймаг", "Орхон аймаг", "Өвөрхангай аймаг", "Өмнөговь аймаг", "Сүхбаатар аймаг", "Сэлэнгэ аймаг", "Төв аймаг", "Увс аймаг", "Ховд аймаг", "Хөвсгөл аймаг", "Хэнтий аймаг"];
        return array_combine($arr,$arr);
    }

    public static function ownershipForms()
    {
        $arr = ['Үндэсний', 'Гадаадын', 'Хамтарсан' ];
        return array_combine($arr,$arr);
    }

    public static function activityCategories()
    {
        return [
            'service' => 'Үйлчилгээ',
            'goods' => 'Бараа материал',
        ];
    }
}
