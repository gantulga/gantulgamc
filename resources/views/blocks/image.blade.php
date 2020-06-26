<?php
$attr = &$block['attributes'];
$attr = array_merge([
    'class' => 'container mx-auto',
],$attr);

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
?>
<figure {!! block_attr($block) !!}>
    @if(isset($attr['link']))
        <a href="{{$attr['link']}}" class="block w-full">
    @endif
    <image-loader src="{{asset($url)}}" class="block w-full"></image-loader>
    @if(isset($attr['caption']))
        <figcaption>{{$attr['caption']}}</figcaption>
    @endif
    @if(isset($attr['link']))
        </a>
    @endif

</figure>
