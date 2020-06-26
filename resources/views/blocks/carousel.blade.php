<?php
$block['attributes']['class'] = '';
$attr = $block['attributes'];
?>

<carousel :per-page="1"  :mouse-drag="false" {!! block_attr($block) !!}>
    @foreach ($attr['slides'] as $i => $slide)
        <?php $isActive = $i==0; ?>
        <slide>
            <bg-loader v-slot="{loading}"
                class="VueCarousel-slide-inner bg-cover bg-grey-lighter w-full {{$isActive?'flex':'hidden'}}"
                {{--style="background-image: url({{asset($slide['image'])}})"--}}
                :src="'{{asset('storage/'.$slide['image'])}}'"
                >
                <div class="overlay" >
                    <div class="container text-white text-center md:text-left">
                        @if($slide['title'])
                            <div>
                                <h1 class="title {{$isActive?'reveal':''}}">{{$slide['title']}}</h2>
                            </div>
                        @endif
                        @if($slide['caption'])
                            <p class="caption md:w-1/2 {{$isActive?'reveal':''}}">
                                {!! $slide['caption'] !!}
                            </p>
                        @endif
                        @if($slide['link'])
                            <div class="{{$isActive?'reveal-in':''}}">
                                @include('components.read-more',['url'=>$slide['link']])
                            </div>
                        @endif
                    </div>
                </div>
            </bg-loader>
        </slide>
    @endforeach
</carousel>

