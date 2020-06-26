<?php
if (! function_exists('block_attr')) {
    function block_attr($block) {
        $attr = array_merge([
            'class' => '',
            'style' => '',
        ],$block['attributes']);

        $id = isset($attr['id'])? 'id="'.$attr['id'].'"' : '';

        $attr['class'] = (isset($block['type'])?'block-'.strtolower($block['type']):'')
                            . ' ' . $attr['class'];

        return $id.' class="'.$attr['class'].'" style="'.$attr['style'].'"';
    }
}
?>

@if(is_array($blocks))
    @foreach ($blocks as $block)
        @if(View::exists('blocks.' . kebab_case($block['type']) ))
            @include('blocks.'.kebab_case($block['type']), ['block'=>$block])
        @else
            <div {!! block_attr($block) !!}>
                {!! $block['attributes']['content'] ?? $block['attributes']['text'] ?? '' !!}
            </div>
        @endif
    @endforeach
@endif
