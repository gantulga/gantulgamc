@extends('layouts.sidebar-left')

@section('title')
    Компаний бүртгэл
@endsection

@section('page-header-image')
    {{asset('img/header-company-registration.jpg')}}
@endsection

<?php //dd($errors); ?>
<?php
$field = function($name, $label, $input, $width_class='w-1/2') use($errors)
{
    return '<div class="'.$width_class.' px-3 my-3 flex flex-col">
        <label>'.$label.'</label>
        '.$input.'
        '.(
            $errors->has($name)
                ?'<p class="text-red text-xs italic">'.$errors->first($name).'.</p>'
                :''
        ).'
    </div>';
};
$input = function($name, $label, $element=null, $attributes=[], $tag='input', $close=false, $inner='', $width_class='w-1/2')
use($field, $errors)
{

    $attributes = array_merge([
        'name' => $name,
        'value' => old($name),
        'type'=>'text',
        //'required' => 'required',
        'class' => 'border p-3 my-2 '.($errors->has($name)?'border-red':''),
    ], $attributes);

    $attributes_html = '';

    foreach ($attributes as $key => $value) {
        $attributes_html .= $key . '="' . htmlspecialchars($value) . '" ';
    }
    if(!$element){
        $element = '<'.$tag.' '.$attributes_html.'>';
        if($close) {
            if($inner) {
                $element .= $inner;
                $attributes['value'] = old($name);
            }
            else {
                $element .= old($name);
            }
            $element .= '</'.$tag.'>';
        }
    }
    return $field($name, $label, $element, $width_class);
};

$textarea = function($name, $label, $attr=[], $width_class='w-1/2') use($input, $field, $errors)
{
    return $input($name, $label, null, array_merge(['rows'=>5],$attr), 'textarea', true, '', $width_class);
};

$select = function($name, $label, $options, $attr = [], $width_class='w-1/2') use($input, $field, $errors)
{
    $attr = array_merge([
        'class' => 'border rounded-none p-3 my-2 '.($errors->has($name)?'border-red':''),
        'style' => "-webkit-appearance:none; -moz-appearance: none;",
        'placeholder' => 'сонгоно уу'
    ], $attr);

    $inner = '<option value>сонгоно уу</option>';

    foreach ($options as $key => $val) {
        $inner .= '<option value="'.$key.'" '.(old($name)==$key?'selected':'').' >'.$val.'</option>';
    }


    return $input($name, $label, null, $attr, 'select', true, $inner, $width_class);
};

?>

@section('content-inner')
    <div id="companyRegister">

    </div>
@endsection

@section('scripts')
    @parent
    <div type="text/x-template" id="reg-form" style="display:none;">
        <form method="POST" enctype="multipart/form-data" action="{{route('company.register')}}" class="text-grey-dark">
            @csrf
            <div class="border-b -mt-5 mb-6">
                <span class="text-primary text-xs font-bold uppercase inline-block pr-2 bg-white relative" style="bottom:-10px;">Компаний мэдээлэл</span>
            </div>
            @if(count($errors))
                @component('components.alert')
                    Алдаануудаа засаад дахин илгээнэ үү.
                @endcomponent
            @endif
            <div class="flex flex-wrap -mx-3">
                {!! $input('name','Ханган нийлүүлэгчийн нэр') !!}
                {!! $input('name_eng','Англи нэр') !!}
                {!! $textarea('about','Танилцуулга') !!}
                {!! $textarea('activities','Үндсэн үйл ажиллагааны  бүх чиглэлийг тодорхой бичих ') !!}
                {!! $select('country','Аль улсад бүртгэлтэй', $countries, ['v-model'=>'country']) !!}
                <div v-if="country=='Монгол'" class="flex-grow">
                    {!! $select('props->hariyalal','Харьяалал', $hariyalal, [], 'w-full') !!}
                </div>
                <div v-if="country!='Монгол'" class="flex-grow">
                    {!! $input('props->hariyalal','Харьяалал', null, [], 'input', false, '', 'w-full') !!}
                </div>
                {!! $input('reg_num','УБДугаар', null, ['maxlength'=>10]) !!}
                {!! $input('address','Албан есны хаяг байршил') !!}
                {!! $input('est_year','Байгуулагдсан он', null, ['type'=>'number', 'maxlength'=>4]) !!}
                {!! $input('tax_num','Татвар төлөгчийн дугаар') !!}
                {!! $input('props->tax_certificate','Татвар төлөгчийн гэрчилгээ (file: .pdf,.doc,.jpg)', null, ['type'=>'file', 'placeholder'=>'.pdf,.doc,.jpg']) !!}
                {!! $input('vat_num','НӨАТ төлөгчийн дугаар') !!}
                {!! $input('props->cooperation_direction', 'Хамтран ажиллах чиглэл') !!}
                {!! $select('activity_category','Үйл ажиллагааны ангилал', $activityCategories) !!}
                {!! $select('ownership_form','Өмчлөлийн хэлбэр ', $ownershipForms) !!}
                {!! $input('props->audit_report','Аудитийн жилийн эцсийн тайлан',null,['type'=>'file']) !!}
                {!! $input('employee_count','Ажилчдын тоо', null, ['type'=>'number']) !!}
                {!! $input('props->dealer_distributer','Албан есны дилер дистрибьютер') !!}
                {!! $textarea('customers','Гол томоохон харилцагчид', [], 'w-full') !!}
            </div>
            <div class="border-b mt-3 mb-6">
                <span class="text-primary text-xs font-bold uppercase inline-block pr-2 bg-white relative" style="bottom:-10px;">Харилцагчийн мэдээлэл</span>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-1/2">
                    <h4 class="mx-3">Захирлын мэдээлэл</h4>
                    {!! $input('props->dir_image','Зураг', null, ['type'=>'file'], 'input', false, '', 'w-full') !!}
                    {!! $input('dir_name','Нэр', null, [], 'input', false, '', 'w-full') !!}
                    {!! $input('dir_pos','Албан тушаал', null, [], 'input', false, '', 'w-full') !!}
                    {!! $input('dir_mobile', '<span class="flex"><i class="material-icons mr-2 text-lg text-primary">phone_iphone</i> гар утасны дугаар</span>', null, [], 'input', false, '', 'w-full') !!}
                    {!! $input('dir_email', '<span class="flex"><i class="material-icons mr-2 text-lg text-primary">email</i> имэйл хаяг</span>', null, ['type'=>'email'], 'input', false, '', 'w-full') !!}
                    {!! $input('dir_fax', '<span class="flex"><i class="material-icons mr-2 text-lg text-primary">email</i> факс</span>', null, [], 'input', false, '', 'w-full') !!}
                </div>
                <div class="w-1/2">
                    <h4 class="mx-3">Харилцах хүний мэдээлэл</h4>
                    {!! $input('props->contact_image','Зураг', null, ['type'=>'file'], 'input', false, '', 'w-full') !!}
                    {!! $input('contact_name','Нэр', null, [], 'input', false, '', 'w-full') !!}
                    {!! $input('contact_pos','Албан тушаал', null, [], 'input', false, '', 'w-full') !!}
                    {!! $input('contact_mobile', '<span class="flex"><i class="material-icons mr-2 text-lg text-primary">phone_iphone</i> гар утасны дугаар</span>', null, [], 'input', false, '', 'w-full') !!}
                    {!! $input('contact_email', '<span class="flex"><i class="material-icons mr-2 text-lg text-primary">email</i> имэйл хаяг</span>', null, ['type'=>'email'], 'input', false, '', 'w-full') !!}
                    {!! $input('contact_fax', '<span class="flex"><i class="material-icons mr-2 text-lg text-primary">email</i> факс</span>', null, [], 'input', false, '', 'w-full') !!}
                </div>
                {!! $textarea('props->questions','Ханган нийлүүлэгчид тавигдах шаардлага /асуултууд/', [], 'w-full') !!}
            </div>
            <div class="text-center p-4">
                <p class="mb-6">
                    <label><input name="terms-of-service" type="checkbox" @if($errors->has('terms-of-service')) class="border border-red" @endif > Үйлчилгээний нөхцөл </label>
                    @if($errors->has('terms-of-service'))
                        <br><span class="text-red text-xs italic">{{$errors->first('terms-of-service')}}</span>
                    @endif
                </p>
                <button class="btn btn-primary uppercase px-10 py-3">Бүртгүүлэх</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        var Form = Vue.component('reg-form', {
            template: '#reg-form',
            data: function(){
                return {
                    country: '{{old("country") ?? key($countries)}}'
                }
            }
        });

        var app = new Vue({
            el: '#companyRegister',
            components: {
                Form
            },
            render: function(createElement) {
                return createElement(Form);
            }
        });


    </script>
@endsection
