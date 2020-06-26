<?php
$attr = $block['attributes'];
?>
<accordion {!! block_attr($block) !!} >
    <div class="shadow-lg mb-4">
    @foreach ($attr['panels'] as $i => $panel)
        <accordion-panel class="" key="{{$panel['id']}}">
            <template v-slot:header="{ toggle, isOpen }">
                <div @click="toggle" class="border-primary border-t-2 bg-white cursor-pointer px-6 py-4">
                    <div class="flex">
                        @if(isset($panel['headerImage']))
                            <div class="w-1/3 -ml-1 flex-none">
                                <image-loader src="{{asset('img/'.$panel['headerImage'].'?w=300')}}" class="block w-full pr-4"></image-loader>
                            </div>
                        @endif
                        <div class="flex-auto items-center">
                            @if(isset($panel['title']))
                                <div class="font-bold text-lg leading-none-">{{$panel['title']}}</div>
                            @endif
                            @if(isset($panel['subtitle']))
                                <p class="text-base text-grey-darker">{{$panel['subtitle']}}</p>
                            @endif
                        </div>

                        <div class="text-primary">
                            <i class="material-icons" :style="'transform: rotate('+(isOpen ? 0 : 180)+'deg); transition-duration: 0.3s;'">expand_less</i>
                        </div>
                    </div>
                </div>
            </template>
            <template v-slot:default="{ toggle, isOpen }">
                <div class="px-6 py-5 border-t border-grey-lighter">
                    @include('blocks.index',['blocks'=>$panel['blocks']])
                </div>
            </template>
        </accordion-panel>

    @endforeach
</div>
</accordion>
