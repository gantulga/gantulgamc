@component('form.fields.wrapper', ['field'=>$field, 'stacked'=>$stacked])

    <input
        id="{{$field['id']}}"
        name="{{$field['id']}}"
        type="{{$field['type']}}"
        placeholder="{{$field['label']}}"
        value="{{ Request::old($field['id']) }}"
        class="shadow appearance-none border {{ $errors->has($field['id']) ? 'border-red' : 'border-grey-darker' }} rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
    >

@endcomponent
