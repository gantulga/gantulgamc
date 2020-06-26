
<form method="GET" action="{{route('post.search')}}" class="text-white text-xl flex text-right">

    <input name="q" type="text" @if(isset($q)) value="{{$q}}" @endif class="bg-transparent border-b border-white flex-grow text-white text-sm" placeholder="{{__('Search')}}">
    <button class="text-white p-0 m-0 inline-block inline-block">
        <i class="material-icons ml-1 -mb-1 text-3xl">search</i>
    </button>
</form>
