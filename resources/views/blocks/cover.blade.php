<?php
$attr = &$block['attributes'];
$attr = array_merge([
    'class' => '',
    'style' => '',
],$attr);

//$attr['class'] .= " bg-cover";

$url = 'img/'.$attr['image'];
if(isset($attr['size'])){
    $size = '';
    $s = explode('x',$attr['size']);
    isset($s[0]) && $size .= 'w='.$s[0];
    count($s)==2 && $size .= '&';
    isset($s[1]) && $size .= 'h='.$s[1];
    count($s)==2 && $size .= '&fit=crop';
    $url .= '?'.$size;
}
$url =asset($url);
//$attr['style'] .= ' background-image: url('.$url .');';
?>

<bg-loader src="{{$url}}" {!! block_attr($block) !!}>
        <div class="container px-4 py-6 flex flex-col z-10">
            @include('blocks.index',['blocks'=>$attr['blocks']??[]])
        </div>

</bg-loader>
