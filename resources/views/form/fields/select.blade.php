@component('form.fields.wrapper', ['field'=>$field, 'stacked'=>$stacked])

    <select
        id="{{$field['id']}}"
        name="{{$field['id']}}"
        type="{{$field['type']}}"
        placeholder="{{$field['label']}}"
        class="shadow appearance-none border {{ $errors->has($field['id']) ? 'border-red' : 'border-grey-darker' }} rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
    >
        <option value="">--</option>
        @foreach ($field['options'] as $option)
            <option value="{{$option}}" {{ Request::old($field['id']) == $option ? 'selected':'' }} >{{$option}}</option>
        @endforeach
    </select>
@endcomponent
