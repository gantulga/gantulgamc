<?php
$stacked = $stacked ?? false;
$groupClass = 'md:flex';
$labelClass = 'md:w-1/4 md:py-3 pr-3';
$inputClass = 'md:w-3/4 py-3';
if($stacked){
    $groupClass = 'flex flex-col';
    $labelClass = 'pt-4 pr-3 pb-2 uppercase text-xs text-left';
    $inputClass = 'pb-4';
}
?>
<div class="{{$groupClass}}">
    <div class="{{$labelClass}}">

        {{$label ?? ''}}

        @if(!isset($label) && isset($field['label']))
            <label for="{{$field['id']}}" class="block text-grey-darker font-bold" >
                {{$field['label']}} {{$field['required']?'*':''}}
            </label>
        @endif

    </div>
    <div class="{{$inputClass}}">

        {{$slot}}

        {!! $errors->first($field['id'], '<p class="text-red text-xs italic">:message</p>') !!}

        @if($field['help'] ?? $field['desc'] ?? false)
            <p class="text-grey-dark text-xs italic">{{ $field['help'] ?? $field['desc'] }}</p>
        @endif

    </div>
</div>
