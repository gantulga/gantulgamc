<?php
$attr = array_merge(['bg'=>''], $block['attributes']);
$i=0;
?>
<vertical-tabs {!! block_attr($block) !!}>
    @foreach ($attr['tabs'] as $tab)
        <tab name="{{$tab['name']}}" {{ $i++==0 ? ':selected="true"' : '' }}  bg="{{asset($attr['bg'])}}">
            @include('blocks.index',['blocks'=>$tab['blocks']])
        </tab>
    @endforeach
</vertical-tabs>
