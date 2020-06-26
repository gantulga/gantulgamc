<div class="-mx-3">
    <ul id="menu-footer" class="list-reset flex flex-col flex-wrap text-base w-full leading-normal" >
        @if($menu)
            @foreach ($menu['items'] as $item)
            <li class="w-1/2 md:w-1/3 mx-0 px-3">
                <a href="{{LaravelLocalization::localizeUrl($item['url'])}}" class="text-primary font-bold uppercase">{{$item['name']}}</a>
                <ul class="list-reset mt-6 mb-8 text-sm ">
                    @foreach (($item['items'] ?? []) as $sub_item)
                    <li><a href="{{LaravelLocalization::localizeUrl($sub_item['url'])}}">{{$sub_item['name']}}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        @endif
    </ul>
</div>
