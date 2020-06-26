<?php
$attr = &$block['attributes'];
$attr = array_merge([
    'class' => '',
],$attr);

$get_url = function($image) use(&$attr){
    $url = 'img/'.$image. '?w=270&h=180&fit=crop';
    return $url;
};



?>
<div {!! block_attr($block) !!}>

    @foreach ($attr['events'] as $i=>$event)
        <div class="event flex">
            <div class="flex-none w-1/4 hidden md:block">
                <img src="{{asset($get_url($event['image']))}}" class="block w-full mb-10 reveal-left"/>
            </div>
            <div class="relative flex flex-grow border-primary border-l-4 ml-3 md:ml-6 pl-6">
                @if($i==0)
                    <div class="absolute z-10 pin-l block bg-white h-10 md:h-16 w-3 -ml-2"></div>
                @endif
                <div class="absolute z-20 pin-l block border-primary border-5 rounded-full bg-white w-6 h-6 mt-6 md:mt-12  reveal-scale" style="height: 24px;width: 24px;left: -14px;">
                </div>
                <div class="ml-1 px-6 py-4 shadow-lg flex-grow mb-10  reveal-right">
                    <div class="datetime text-secondary mb-3 font-bold">{{$event['datetime']}}</div>
                    <h3 class="title text-lg">{{ $event['title']}}</h3>
                    {!!$event['description']!!}
                </div>
            </div>
        </div>
    @endforeach

</div>
