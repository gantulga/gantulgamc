<?php
//dd($block);
$attr = &$block['attributes'];
$attr = array_merge([
    'class' => '',
    'style' => '',
],$attr);
$attr['class'] .= ' max-w-sm flex flex-grow';

if(trim($attr['image'] ?? false)){
    $url = 'img/'.$attr['image'];
    if(trim($attr['imageSize'] ?? false, '-')){
        $size = '';
        $s = explode('x',$attr['imageSize']);
        isset($s[0]) && $size .= 'w='.$s[0];
        count($s)==2 && $size .= '&';
        isset($s[1]) && $size .= 'h='.$s[1];
        count($s)==2 && $size .= '&fit=crop';
        $url .= '?'.$size;
    }
    $url =asset($url);
    //$attr['style'] .= ' background-image: url('.$url .');';
}

?>

<div {!! block_attr($block) !!}>
    <div class="rounded overflow-hidden shadow-lg leading-normal w-full" >
        @if(trim($attr['link'] ?? false))
            <a href="{{url($attr['link'])}}">
        @endif
        @if(trim($attr['image'] ?? false))
            <img class="block w-full" src="{{$url}}" >
        @endif
        @if(trim($attr['link'] ?? false))
            </a>
        @endif
        <div class="p-6 pt-4 pb-5">
            @if(trim($attr['title'] ?? false))
                <div class="{{ $attr['text'] ?? false ? 'mb-2':'' }}">
                    @if(trim($attr['link'] ?? false))
                        <a href="{{url($attr['link'])}}">
                    @endif
                    <div class="font-bold text-lg">{{$attr['title']}}</div>
                    @if(trim($attr['link'] ?? false))
                        </a>
                    @endif
                </div>
            @endif
            @if(trim($attr['text'] ?? false))
                <div class="text-grey-darker text-base">
                    {!!$attr['text']!!}
                </div>
            @endif
        </div>
    </div>
</div>
