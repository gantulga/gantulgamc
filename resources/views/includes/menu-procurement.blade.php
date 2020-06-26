<ul id="menu-procurement" class="list-reset mt-4 no-underline text-xs font-bold mr-4 uppercase">
    {{--
        <li class="my-3"><a class="block text-primary flex items-center justify-between" href="{{route('procurement')}}"> Тендерийн урилга <i class="material-icons ml-1">chevron_right</i></a> </li>
        <li class="my-3"><a class="block text-grey-dark" href="{{url('procurement/policy')}}"> Худалдан авалтын бодлого </a> </li>
        <li class="my-3"><a class="block text-grey-dark" href="{{route('company.register')}}"> Компаний бүртгэл </a> </li>
        <li class="my-3"><a class="block text-grey-dark" href="{{url('procurement/result')}}"> Тендерийн үр дүн </a> </li>
        <li class="my-3"><a class="block text-grey-dark" href="{{url('procurement/documents')}}"> Бүрдүүлэх материал </a> </li>
        <li class="my-3 mb-0"><a class="block text-grey-dark" href="{{url('procurement/products-for-sale')}}"> Худалдах бараа материал </a> </li>
    --}}
@if($menu)
    @foreach ($menu['items']??[] as $i => $item)
        @if($i==0)
            <li class="my-3"><a class="block text-primary flex items-center justify-between" href="{{LaravelLocalization::localizeUrl($item['url'])}}"> {{$item['name']}} <i class="material-icons ml-1">chevron_right</i></a> </li>
        @elseif(($i+1)<count($menu['items']))
            <li class="my-3"><a class="block text-grey-dark" href="{{LaravelLocalization::localizeUrl($item['url'])}}">{{$item['name']}}</a></li>
        @else
            <li class="my-3 mb-0"><a class="block text-grey-dark" href="{{LaravelLocalization::localizeUrl($item['url'])}}">{{$item['name']}}</a></li>
        @endif
    @endforeach
@endif
</ul>
