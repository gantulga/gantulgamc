<?php
$attr = &$block['attributes'];
$attr = array_merge([
    'class' => 'container mx-auto flex flex-wrap',
],$attr);
$cols = $attr['columns'] ?? 3;
$attr['class'] .= ' cols-'.$cols;

$get_url = function($image) use(&$attr, $cols){
    $url = 'img/'.$image;
    $size = '';
    if(isset($attr['size'])){
        $s = explode('x',$attr['size']);
        isset($s[0]) && $size .= 'w='.$s[0];
        count($s)==2 && $size .= '&';
        isset($s[1]) && $size .= 'h='.$s[1];
        count($s)==2 && $size .= '&fit=crop';
    }
    else{
        switch ($cols) {
            case 1:
                $size = 'w=768&h=576&fit=crop';
            break;
            case 2:
                $size = 'w=512&h=384&fit=crop';
            break;
            case 3:
                $size = 'w=320&h=180&fit=crop';
            break;
            case 4:
                $size = 'w=270&h=180&fit=crop';
            break;
            default:
                $size = 'w=256&h=192&fit=crop';
            break;
        }
    }
    $url .= '?'.$size;
    return $url;
};

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
    <div class="-m-2 flex flex-wrap flex-grow w-full text-center justify-center-">
    @foreach ($attr['images'] as $i => $img)
        <?php $attr['images'][$i]['src'] = asset('/storage/'.$img['image']); ?>
        <div class="{{ $get_class($cols) }}">
            <figure class="block">
                @if(isset($img['link']))
                <a href="{{$img['link']}}" class="block w-full">
                    @endif
                <img src="{{asset($get_url($img['image']))}}" class="block w-full cursor-pointer" @click="$refs.lightbox.clickImage({{$i}})"  />
                    @if(isset($img['caption']))
                    <figcaption class="cursor-pointer text-xs" @click="$refs.lightbox.clickImage({{$i}})">{{$img['caption']}}</figcaption>
                    @endif
                    @if(isset($img['link']))
                </a>
                @endif

            </figure>
        </div>
    @endforeach
    <lightbox ref="lightbox" :images="{{json_encode($attr['images'])}}"></lightbox>
    </div>
</div>
