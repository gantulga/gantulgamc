<?php
$attr = $block['attributes'] = array_merge([
    'class' => 'flex flex-wrap container mx-auto px-4',
],$block['attributes']);
?>
<div {!! block_attr($block) !!}>
    @foreach($attr['columns'] as $col)
        <?php
            $col = array_merge([
                'class' => ''
            ],$col);
            $col['class'] .= ' col '.(isset($col['width'])?'md:w-'.$col['width']:'');
        ?>
        <div {!! block_attr(['attributes'=>$col]) !!}  >
            @include('blocks.index',['blocks'=>$col['blocks']])
        </div>
    @endforeach
</div>
