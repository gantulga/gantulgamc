@component('form.fields.wrapper', ['field'=>$field, 'stacked'=>$stacked])

    @foreach ($field['options'] as $option)
        <label class="flex items-start mb-3">
            <div class="w-6 align-top">
                {!! Form::radio($field['id'], $option, Request::old($field['id']) == $option, [
                    'class'=> $errors->has($field['id']) ? 'border-red' : 'border-grey-darker'
                ]) !!}

            </div>
            <span class="flex-1">{{$option}}</span>
        </label>
    @endforeach

@endcomponent
