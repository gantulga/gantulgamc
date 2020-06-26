<?php
$stacked = $stacked ?? $form->settings['stacked'] ?? true;
$formId = 'form-'.$form->name;
?>

<h1>{{$form->title}}</h1>

@include('form.alert')

@if(isset($form->settings['description']))
    <div class="mb-3">
        {!! $form->settings['description'] !!}
    </div>
@endif

{!! Form::open(['route'=>['form', $form], 'id'=>$formId, /*'onSubmit'=>'submitForm(event)'*/ ]) !!}
    @include('form.hidden-fields')

    @foreach ($form->fields as $field)
        <?php $fieldView = 'form.fields.' . kebab_case($field['type']); ?>
        <?php $fieldView = View::exists($fieldView) ? $fieldView : 'form.fields.default'; ?>
        @include($fieldView, ['field'=>$field, 'stacked'=> $stacked])
    @endforeach

    @include('form.actions')
{!! Form::close() !!}
{{--
@section('scripts')
    @parent
    <script type="text/javascript" src="{{mix('js/axios.js')}}"></script>
    <script>
        async function submitForm(event){
            event.preventDefault();
            var form = document.getElementById("{{$formId}}");
            var formData = new FormData(form);
            try{
                const response = await axios.post(form.action,formData)
                console.log(response)
            } catch (error) {
                if (error.response.status == 422) {
                    this.validationErrors = new Errors(error.response.data.errors)
                }
            }
        }
    </script>
@endsection
--}}
