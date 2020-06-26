
<ul id="menu-sidebar" class="list-reset w-full font-bold uppercase border-t border-grey-lighter" >
@if($menu)
    @foreach ($menu['items'] as $item)
        @if(Request::is($item['url']) || Request::is($item['url'].'/*'))
            @foreach (($item['items'] ?? []) as $i => $sub_item)
                <?php
                $a_class = 'block px-1 py-3 hover:text-primary flex items-center justify-between';
                $a_class .= ' '.($sub_item['options']['class'] ?? '');
                $a_class .= Request::is($sub_item['url']) || ($i!=0 && Request::is($sub_item['url'].'/*')) // && isset($sub_item['items']) && count($sub_item['items'])
                            ? ' text-primary border-l-4 border-primary pl-4'
                            : ' text-grey-dark';
                ?>

                <li class="border-b border-grey-lighter">
                    <a class="{{$a_class}}" href="{{ LaravelLocalization::localizeUrl($sub_item['url'])}}">
                        {{$sub_item['name']}}
                        @if(Request::is($sub_item['url']) || ($i!=0 && Request::is($sub_item['url'].'/*') && (!isset($sub_item['items']) || !count($sub_item['items']) )) )
                            <i class="material-icons ml-1">chevron_right</i>
                        @endif
                    </a>
                    @if(Request::is($sub_item['url']) || Request::is($sub_item['url'].'/*'))
                        @if(isset($sub_item['items']) && count($sub_item['items']))
                            <ul class="list-reset pl-8 py-2 text-xs border-t border-grey-lighter">
                                @foreach ($sub_item['items'] as $sub_sub_item)
                                    <?php
                                    $a_sub_class = 'block py-2 hover:text-primary flex items-center justify-between';
                                    $a_sub_class .= ' '.($sub_item['options']['class'] ?? '');
                                    $a_sub_class .= Request::is($sub_sub_item['url']) || (Request::is($sub_sub_item['url'].'/*') &&  isset($sub_sub_item['items']) && count($sub_sub_item['items']))
                                                ? ' text-primary '
                                                : ' text-grey-dark';
                                    ?>
                                    <li>
                                        <a class="{{$a_sub_class}}" href="{{LaravelLocalization::localizeUrl($sub_sub_item['url'])}}">
                                            {{$sub_sub_item['name']}}
                                            @if(Request::is($sub_sub_item['url']))
                                                <i class="material-icons ml-1">chevron_right</i>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </li>
            @endforeach
        @endif
    @endforeach
@endif
</ul>

