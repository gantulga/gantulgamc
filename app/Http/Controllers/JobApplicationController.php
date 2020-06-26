<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\JobApplication;
use App\JobApplicationStatus;
use App\PublishStatus;

use function GuzzleHttp\json_decode;

class JobApplicationController extends Controller
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
    public function show(Request $request)
    {
        $job = $this->getJob($request->vacancy);
        $aimguud = ["Улаанбаатар", "Архангай", "Баян-Өлгий", "Баянхонгор", "Булган", "Говь-Алтай", "Говьсүмбэр", "Дархан-Уул", "Дорноговь", "Дорнод", "Дундговь", "Завхан", "Орхон", "Өвөрхангай", "Өмнөговь", "Сүхбаатар", "Сэлэнгэ", "Төв", "Увс", "Ховд", "Хөвсгөл", "Хэнтий"];
        $sumuud = ["Архангай" => ["Батцэнгэл сум", "Булган сум", "Жаргалант сум", "Ихтамир сум", "Өгийнуур сум", "Өлзийт сум", "Өндөр-Улаан сум", "Тариат сум", "Цахир сум", "Түвшрүүлэх сум", "Хайрхан сум", "Хангай сум", "Хашаат сум", "Хотонт сум", "Цэнхэр сум", "Чулуут сум", "Эрдэнэбулган сум", "Эрдэнэмандал сум",], "Баян-Өлгий" => ["Алтай сум", "Алтанцөгц сум", "Баяннуур сум", "Бугат сум", "Булган сум", "Буянт сум", "Дэлүүн сум", "Ногооннуур сум", "Өлгий сум", "Сагсай сум", "Толбо сум", "Улаанхус сум", "Цэнгэл сум",], "Баянхонгор" => ["Баянхонгор сум", "Баацагаан сум", "Баянбулаг сум", "Баянговь сум", "Баянлиг сум", "Баян-Овоо сум", "Баян-Өндөр сум", "Баянцагаан сум", "Богд сум", "Бөмбөгөр сум", "Бууцагаан сум", "Галуут сум", "Гурванбулаг сум", "Жаргалант сум", "Жинст сум", "Заг сум", "Өлзийт сум", "Хүрээмарал сум", "Шинэжинст сум", "Эрдэнэцогт сум",], "Булган" => ["Булган сум", "Баян-Агт сум", "Баяннуур сум", "Бугат сум", "Бүрэгхангай сум", "Гурванбулаг сум", "Дашинчилэн сум", "Могод сум", "Орхон сум", "Рашаант сум", "Сайхан сум", "Сэлэнгэ сум", "Тэшиг сум", "Хангал сум", "Хишиг-Өндөр сум", "Хутаг-Өндөр сум",], "Говь-Алтай" => ["Алтай сум", "Баян-Уул сум", "Бигэр сум", "Бугат сум", "Дарви сум", "Дэлгэр сум", "Есөнбулаг сум", "Жаргалан сум", "Тайшир сум", "Тонхил сум", "Төгрөг сум", "Халиун сум", "Хөхморьт сум", "Цогт сум", "Цээл сум", "Чандмань сум", "Шарга сум", "Эрдэнэ сум",], "Говьсүмбэр" => ["Сүмбэр сум", "Баянтал сум", "Шивээговь сум",], "Дархан-Уул" => ["Дархан", "Хонгор сум", "Орхон сум", "Шарынгол сум",], "Дорноговь" => ["Айраг сум", "Алтанширээ сум", "Даланжаргалан сум", "Дэлгэрэх сум", "Замын-Үүд сум", "Иххэт сум", "Мандах сум", "Өргөн сум", "Сайхандулаан сум", "Улаанбадрах сум", "Хатанбулаг сум", "Хөвсгөл сум", "Эрдэнэ сум",], "Дорнод" => ["Баяндун сум", "Баянтүмэн сум", "Баян-Уул сум", "Булган сум", "Гурванзагал сум", "Дашбалбар сум", "Матад сум", "Сэргэлэн сум", "Халхгол сум", "Хөлөнбуйр сум", "Хэрлэн (Сүмбэр)", "Цагаан-Овоо сум", "Чулуунхороот сум (Эрээнцав)", "Чойбалсан сум",], "Дундговь" => ["Адаацаг сум", "Баянжаргалан сум", "Говь-Угтаал сум", "Гурвансайхан сум", "Дэлгэрхангай сум", "Дэлгэрцогт сум", "Дэрэн сум", "Луус сум", "Өлзийт сум", "Өндөршил сум", "Сайхан-Овоо сум", "Сайнцагаан сум", "Хулд сум", "Цагаандэлгэр сум", "Эрдэнэдалай сум",], "Завхан" => ["Алдархаан сум", "Асгат сум", "Баянтэс сум", "Баянхайрхан сум", "Дөрвөлжин сум", "Завханмандал сум", "Идэр сум", "Их-Уул сум", "Нөмрөг сум", "Отгон сум", "Сантмаргац сум", "Сонгино сум", "Тосонцэнгэл сум", "Түдэвтэй сум", "Тэлмэн сум", "Тэс сум", "Ургамал сум", "Цагаанхайрхан сум", "Цагаанчулуут сум", "Цэцэн-Уул сум", "Шилүүстэй сум", "Эрдэнэхайрхан сум", "Яруу сум",], "Орхон" => ["Баян-Өндөр сум", "Жаргалант сум",], "Өвөрхангай" => ["Арвайхээр", "Баруунбаян-Улаан сум", "Бат-Өлзий сум", "Баянгол сум", "Баян-Өндөр сум", "Богд сум", "Бүрд сум", "Гучин-Ус сум", "Хархорин сум", "Хайрхандулаан сум", "Хужирт сум", "Нарийнтээл сум", "Өлзийт сум", "Сант сум", "Тарагт сум", "Төгрөг сум", "Уянга сум", "Есөнзүйл сум", "Зүүнбаян-Улаан сум",], "Өмнөговь" => ["Баяндалай сум", "Баян-Овоо сум", "Булган сум", "Гурвантэс сум", "Мандал-Овоо сум", "Манлай сум", "Ноён сум", "Номгон сум", "Сэврэй сум", "Ханбогд сум", "Ханхонгор сум", "Хүрмэн сум", "Цогт-Овоо сум", "Цогтцэций сум (Тавантолгой)",], "Сүхбаатар" => ["Асгат сум", "Баяндэлгэр сум", "Дарьганга сум", "Мөнххаан сум", "Наран сум", "Онгон сум", "Сүхбаатар сум", "Түвшинширээ сум", "Түмэнцогт сум", "Уулбаян сум", "Халзан сум", "Эрдэнэцагаан сум",], "Сэлэнгэ" => ["Алтанбулаг сум", "Баруунбүрэн сум", "Баянгол сум", "Ерөө сум", "Жавхлант сум", "Зүүнбүрэн сум", "Мандал сум", "Орхон сум", "Орхонтуул сум", "Сайхан сум", "Сант сум", "Сүхбаатар сум", "Түшиг сум", "Хүдэр сум", "Хушаат сум", "Цагааннуур сум", "Шаамар сум",], "Төв" => ["Алтанбулаг сум", "Аргалант сум", "Архуст сум", "Баян сум", "Батсүмбэр сум", "Баяндэлгэр сум", "Баянжаргалан сум", "Баян-Өнжүүл сум", "Баянхангай сум", "Баянцагаан сум", "Баянцогт сум", "Баянчандмань сум", "Борнуур сум", "Бүрэн сум", "Дэлгэрхаан сум", "Жаргалант сум", "Заамар сум", "Лүн сум", "Мөнгөнморьт сум", "Өндөрширээт сум", "Сэргэлэн сум", "Сүмбэр сум", "Угтаал сум", "Цээл сум", "Эрдэнэ сум", "Эрдэнэсант сум",], "Увс" => ["Баруунтуруун сум", "Бөхмөрөн сум", "Давст сум", "Завхан сум", "Зүүнговь сум", "Зүүнхангай сум", "Малчин сум", "Наранбулаг сум", "Өлгий сум", "Өмнөговь сум", "Өндөрхангай сум", "Сагил сум", "Тариалан сум", "Тэс сум", "Түргэн сум", "Улаангом сум", "Ховд сум", "Хяргас сум", "Цагаанхайрхан сум",], "Ховд" => ["Ховд (Жаргалант)", "Алтай сум", "Булган сум", "Буянт сум", "Дарви сум", "Дөргөн сум", "Дуут сум", "Зэрэг сум", "Манхан сум", "Мөнххайрхан сум", "Мөст сум", "Мянгад сум", "Үенч сум", "Ховд сум", "Цэцэг сум", "Чандмань сум", "Эрдэнэбүрэн сум",], "Хөвсгөл" => ["Алаг-Эрдэнэ сум", "Арбулаг сум", "Баянзүрх сум", "Бүрэнтогтох сум", "Галт сум", "Жаргалант сум", "Их-Уул сум", "Мөрөн сум", "Рашаант сум", "Рэнчинлхүмбэ сум", "Тариалан сум", "Тосонцэнгэл сум", "Төмөрбулаг сум", "Түнэл сум", "Улаан-Уул сум", "Ханх сум", "Хатгал сум", "Цагааннуур сум", "Цагаан-Уул сум", "Цагаан-Үүр сум", "Цэцэрлэг сум", "Чандмань-Өндөр сум", "Шинэ-Идэр сум", "Эрдэнэбулган сум",], "Хэнтий" => ["Батноров сум", "Батширээт сум", "Баян-Адрага сум", "Баянмөнх сум", "Баян-Овоо сум", "Баянхутаг сум", "Биндэр сум", "Галшар сум", "Дадал сум", "Дархан сум", "Дэлгэрхаан сум", "Жаргалтхаан сум", "Мөрөн сум", "Норовлин сум", "Өмнөдэлгэр сум", "Хэрлэн сум", "Цэнхэрмандал сум",], "Улаанбаатар" => ["Багануур", "Багахангай", "Баянгол", "Баянзүрх", "Налайх", "Сонгинохайрхан", "Сүхбаатар", "Хан-Уул"]];
        $relatives = ["Авга", "Ах", "Ач", "Баз", "Бэр", "Өвөө", "Дүү", "Зээ", "Нагац", "Найз залуу", "Нөхөр", "Охин", "Хадам ах", "Хадам дүү", "Хадам эгч", "Хадам эх", "Хадам эцэг", "Хамтран амьдрагч", "Хүргэн", "Хүү", "Эгч", "Эмээ", "Эх", "Эхнэр", "Эцэг",];

        return view('job-application.show', ['job' => $job, 'aimguud' => $aimguud, 'sumuud' => $sumuud, 'relatives' => $relatives]);
    }

    /**
     * Post a form entry.
     *
     * @param  Request  $request
     * @return Redirect
     */
    public function post(Request $request)
    {
        $job = $this->getJob($request->vacancy);

        $request->validate([
            'regnum' => ['required', 'regex:/^([а-яА-Я|Өө|Ёё|Үү]{2})([0-9]{8})$/u'],
            'photo' => 'required|image|mimes:jpeg,jpg,bmp,png|max:400',
            'nationality' => 'required',
            'familyname' => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'birthplace.aimag' => 'required',
            'birthplace.sum' => 'required',
            'birthplace.place' => 'required',
            'etnicity' => 'required',
            'familymembers' => 'required',
            'familymembers.0.relation' => 'required',
            'familymembers.0.name' => 'required|min:3',
            'familymembers.0.job' => 'required|min:3',
            'address.aimag' => 'required',
            'address.sum' => 'required',
            'address.bagh' => 'required',
            'address.address' => 'required',
            'address.phone' => 'required',
            '*.email' => 'nullable|email',
            '*.phone' => 'nullable|regex:/[0-9]/',
            '*.phone1' => 'nullable|regex:/[0-9]/',
            'id_copy' => 'required|mimes:pdf,jpeg,jpg,bmp,png',
            'diploma_copy' => 'mimes:pdf,jpeg,jpg,bmp,png',
            'social_insurance_copy' => 'mimes:pdf,jpeg,jpg,bmp,png',
        ], [
            'required' => 'Талбарыг оруулах шаардлагай.',
            'regnum.regex' => 'Регистрийн дугаар буруу байна.',
            'image' => 'Зөвхөн зурган файл илгээнэ үү.',
            'photo.mimes' => 'Зөвхөн jpeg, jpg, bmp, png өргөтгөлтэй файл илгээнэ үү.',
            'photo.max' => 'Зургийн хэмжээ :max КВ -аас ихгүй байна.',
            'max' => 'Файлын хэмжээ :max КВ -аас ихгүй байна.',
            'mimes' => 'Зөвхөн :values төрлийн файл илгээх боломжтой.',
            'email' => 'Имэйл хаяг буруу байна.',
            '*.phone.regex' => 'Утасны дугаар буруу байна.',
            '*.phone1.regex' => 'Утасны дугаар буруу байна.',
        ]);

        $msg = 'Анкет илгээсэнд баярлалаа. Бид таньтай эргээд холбоо барих болно.';

        $application = new JobApplication;
        $application->ip = $request->ip();
        $application->request_data = (string) $request;
        $application->status = JobApplicationStatus::PENDING;
        $application->regnum = $request->regnum;
        $application->firstname = $request->firstname;
        $application->lastname = $request->lastname;
        $application->phone = $request->address['phone'];
        $application->email = $request->address['email'];
        $application->attributes = [
            'nationality' => $request->nationality,
            'familyname' => $request->familyname,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'birthplace' => $request->birthplace,
            'etnicity' => $request->etnicity,
            'familymembers' => $request->familymembers,
            'relatives' => $request->relatives,
            'address' => $request->address,
            'emergency_contact' => $request->emergency_contact,
            'education' => $request->education,
            'education_doctorate' => $request->education_doctorate,
            'specialization_courses' => $request->specialization_courses,
            'academic_degrees' => $request->academic_degrees,
            'military_service' => $request->military_service,
            'rewards' => $request->rewards,
            'work_experiences' => $request->work_experiences,
            'works_publications' => $request->works_publications,
            'id_copy' => $request->id_copy ? $request->id_copy->store('/job-application', 'public') : null,
            'diploma_copy' => $request->diploma_copy ? $request->diploma_copy->store('/job-application', 'public') : null,
            'social_insurance_copy' => $request->social_insurance_copy ? $request->social_insurance_copy->store('/job-application', 'public') : null,
        ];

        $application->photo = $request->photo->store('/job-application', 'public');

        if ($job->applications()->save($application)) {

            if ($request->ajax()) {
                return response()->json([
                    'message' => $msg,
                ]);
            }
            return back()
                ->with('application-success', $msg);
        }

        if ($request->ajax()) {
            return response()->json([
                'data' => session()->getOldInput(),
            ]);
        }
        return back()->withInput();
    }

    private function getJob($id)
    {
        $job = Job::findByIdBase36($id);

        if ($job == null || $job->status != PublishStatus::PUBLISH) {
            abort(404);
        }

        if($job->isExpired()){
            abort(403, 'Анкет хүлээж авах хугацаа хэтэрсэн байна.');
        }

        return $job;
    }

    private function test()
    {
        $arr = array_map(function ($el) {
            return trim($el);
        }, explode(
            PHP_EOL,
            ''
        ));
        //$aimag = ''; $sum='';
        //$aold = '';
        foreach ($arr as $key => $value) {
            /*
            [$aimag, $sum] = explode(':::',$value);
            if($aimag!=$aold){
                echo '],"'.trim($aimag).'"=>[';
            }
            echo '"'.trim($sum).'",';
            $aold = $aimag;
            */
            if (trim($value))
                echo '"' . trim($value) . '",';
        }
        //echo ']';
        exit;
    }
}
