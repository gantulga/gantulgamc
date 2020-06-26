
<ul id="menu-hr" class="list-reset -mt-3 no-underline text-xs font-bold">
@if($menu)
    @foreach ($menu['items']??[] as $item)
        <li class="my-3"><a class="text-white" href="{{LaravelLocalization::localizeUrl($item['url'])}}">{{$item['name']}}</a></li>
    @endforeach
@endif
</ul>
