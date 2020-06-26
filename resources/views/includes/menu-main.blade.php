<ul id="menu-main" class="md:flex md:items-center list-reset uppercase text-xs font-bold">
    @if($menu)
        @foreach ($menu['items'] as $item)
        <?php
        $li_class = ' md:ml-4 md:pt-4 md:pb-4';
        $a_class = ' block no-underline px-1 py-3 group-hover:text-primary';
        $a_class .= ' '.($item['props']['class'] ?? '');

        if(Request::is($item['url']) || Request::is($item['url'].'/*')) {
            $li_class .= ' active '; //md:pb-3 md:border-b-4 md:border-primary
            $a_class .= ' text-primary';
        }
        else {
            $li_class .= ' '; //md:pb-4
            $a_class .= ' text-black';
        }
        ?>
        <li class="{{$li_class}} relative group ">
            <a class="{{$a_class}}" href="{{LaravelLocalization::localizeUrl($item['url'])}}">{{$item['name']}}</a>
            @if(count($item['items']))
                <div class="absolute shadow z-20 invisible group-hover:visible overflow-hidden max-h-0 group-hover:max-h-screen" style="transition: max-height .5s ease-in;">
                    <div class="bg-white rounded border " >
                        @foreach ($item['items'] as $i=>$sub_item)
                            <?php
                            $sa_class = ' no-underline block px-4 py-3 bg-white hover:text-primary whitespace-no-wrap';
                            $sa_class .= ' '.($sub_item['props']['class'] ?? '');
                            $sa_class .= $sub_item['url'];
                            if(Request::is($sub_item['url']) || ($i!=0 && Request::is($sub_item['url'].'/*'))) {
                                $sa_class .= ' text-primary';
                            }
                            else {
                                $sa_class .= ' text-grey-darkest';
                            }
                            if($i+1 < count($item['items'])){
                                $sa_class .= ' border-b';
                            }
                            ?>
                            <a href="{{LaravelLocalization::localizeUrl($sub_item['url'])}}" class="{{$sa_class}}">
                                {{$sub_item['name']}}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </li>
        @endforeach
    @endif
</ul>
