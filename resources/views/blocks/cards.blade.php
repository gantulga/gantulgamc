<?php
$attr = &$block['attributes'];
$attr = array_merge([
    'class' => 'container mx-auto flex flex-wrap',
],$attr);
$cols = $attr['columns'] ?? 3;
$attr['class'] .= ' cols-'.$cols;

$get_class=function($cols){
    $class = '';
    switch ($cols) {
        case 1:
            $class = ' mx-auto';
        break;
        case 2:
            $class = 'w-full sm:w-1/2 md:w-1/2 p-2';
        break;
        case 3:
            $class = 'w-full sm:w-1/2 md:w-1/3 p-2';
        break;
        case 4:
            $class = 'w-full sm:w-1/2 md:w-1/4 p-2';
        break;
        case 5:
            $class = 'w-full sm:w-1/2 md:w-1/5 p-2';
        break;
        case 6:
            $class = 'w-full sm:w-1/3 md:w-1/6 p-2';
        break;
        default:
            $class = ' inline-block p-2';
        break;
    }
    return $class;
};

?>
<div {!! block_attr($block) !!}>
    <div class="-m-2 flex flex-wrap flex-grow w-full">
    @foreach ($attr['cards'] as $i => $card)
        <?php $card['attributes']['imageSize'] = $attr['imageSize']; ?>
        <div class="{{ $get_class($cols) }} flex">
            @include('blocks.card', ['block'=>$card])
            {{--$card['attributes']['title']--}}
        </div>
    @endforeach
    </div>
</div>
