<?php

$props = json_encode([
    'success' => session('application-success'),
    'errors' => $errors->toArray(),
    'values' => array_merge([
        'familymembers' => [new stdClass],
        'birthplace' => new stdClass,
        'relatives' => [new stdClass],
        'address' => new stdClass,
        'emergency_contact' => new stdClass,
        'education'=>[new stdClass],
        'education_doctorate'=>[new stdClass],
        'specialization_courses' => [new stdClass],
        'academic_degrees'=>[new stdClass],
        'military_services'=>[new stdClass],
        'rewards'=>[new stdClass],
        'work_experiences'=>[new stdClass],
        'works_publications'=>[new stdClass],
    ],session()->getOldInput()),
    'options' => [
        'gender' => [['male'=>'Эрэгтэй'],['female'=>'Эмэгтэй']],
        'yesno' => ['yes'=>'Тийм', 'no'=>'Үгүй'],
        'relatives'=> $relatives,
        'aimguud' => $aimguud,
        'sumuud' => $sumuud,
    ]
]);

?>
<f-form action="{{route('job-application', ['vacancy'=>$job->id36()])}}" v-slot="{values, errors, options, submitting}" v-bind="{{$props}}" >

    @include('form/hidden-fields')
    @include('job-application.includes.notice')
    <h3 class="mb-6">Нэг. Хувь хүний талаарх мэдээлэл</h3>
    <div class="md:w-1/3 md:float-right md:pl-8">
        <f-image-field name="photo" label="Зураг" v-model="values.photo"  :errors="errors" :horizontal="false"></f-image-field>
    </div>
    <div class="md:w-2/3">
        <f-text-field name="regnum" label="Регистрийн дугаар" v-model="values.regnum"  :errors="errors"></f-text-field>
        <f-text-field name="nationality" label="1.1. Иргэншил" v-model="values.nationality" :errors="errors"></f-text-field>
        <f-text-field name="familyname" label="1.2. Ургийн овог" v-model="values.familyname" :errors="errors"></f-text-field>
        <f-text-field name="lastname" label="1.3. Эцэг (эх)-ийн нэр" v-model="values.lastname" :errors="errors"> </f-text-field>
        <f-text-field name="firstname" label="1.4. Өөрийн нэр" v-model="values.firstname" :errors="errors"></f-text-field>
        <f-radio-field name="gender" :options="options.gender" label="1.5. Хүйс" v-model="values.gender" :errors="errors"></f-radio-field>
        <f-datetime-field name="birthdate" label="1.6. Төрсөн огноо" v-model="values.birthdate" t :errors="errors"></f-datetime-field>
        <f-field-wrapper label="1.7. Төрсөн" >
            <div class="flex">
                <f-select-field class="w-1/2 mr-1" name="birthplace[aimag]" :horizontal="false" :options="options.aimguud" label="Аймаг, хот" v-model="values.birthplace.aimag" :errors="errors"></f-select-field>
                <f-select-field class="w-1/2 ml-1" name="birthplace[sum]" :horizontal="false" :options="options.sumuud[values.birthplace.aimag]||[]" label="Сум, дүүрэг" v-model="values.birthplace.sum" :errors="errors"></f-select-field>
            </div>
            <f-text-field name="birthplace[place]" :horizontal="false" label="Төрсөн газар" v-model="values.birthplace.place"  :errors="errors"></f-text-field>
        </f-field-wrapper>
        <f-text-field name="etnicity" label="1.8. Үндэс, угсаа" v-model="values.etnicity"  :errors="errors"></f-text-field>
    </div>

    @include('job-application.includes.family')
    @include('job-application.includes.relatives')
    @include('job-application.includes.address')
    @include('job-application.includes.emergency-contact')


    <h3 class="mt-10 mb-4">Хоёр. Боловсролын талаарх мэдээлэл</h3>
    @include('job-application.includes.education')
    @include('job-application.includes.education-doctorate')

    <h3 class="mt-10 mb-4">Гурав. Мэргэшлийн талаарх мэдээлэл</h3>
    @include('job-application.includes.specialization-courses')
    @include('job-application.includes.academic-degrees')

    <h3 class="mt-10 mb-4">Дөрөв. Цэргийн алба хаасан эсэх</h3>
    @include('job-application.includes.military-service')

    <h3 class="mt-10 mb-4">Тав. Шагналын талаарх мэдээлэл</h3>
    @include('job-application.includes.rewards')

    <h3 class="mt-10 mb-4">Зургаа. Туршлагын талаарх мэдээлэл</h3>
    @include('job-application.includes.work-experiences')

    <h3 class="mt-12 mb-4">Долоо. Бүтээлийн жагсаалт</h3>
    @include('job-application.includes.works-publications')

    <h3 class="mt-12 mb-4">Файлууд</h3>
    <f-file-field name="id_copy" label="Иргэний үнэмлэхийн хуулбар" v-model="values.id_copy"  :errors="errors"></f-file-field>
    <f-file-field name="diploma_copy" label="Дипломын хуулбар" v-model="values.diploma_copy"  :errors="errors"></f-file-field>
    <f-file-field name="social_insurance_copy" label="Нийгмийн даатгалын дэвтрийн хуулбар" v-model="values.social_insurance_copy"  :errors="errors"></f-file-field>

    <div class="text-center mt-10 mb-4">
        <button type="submit" :disabled="submitting" class="btn btn-primary text-lg w-full md:w-48 px-6 py-3 rounded cursor-pointer">Илгээх</button>
    </div>

</f-form>

@section('scripts')
    @parent
    <script type="text/javascript" src="{{mix('js/axios.js')}}"></script>
    <script type="text/javascript" src="{{mix('js/form.js')}}"></script>
@endsection
