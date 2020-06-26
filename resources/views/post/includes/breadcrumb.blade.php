<div class="border-b border-primary pb-3 flex items-center">
    <h3 class="text-xs uppercase inline-block">
        <a class="text-grey-dark" href="{{route('post')}}">{{__('News')}}</a>
    </h3>
    <i class="material-icons text-primary text-normal -my-1">chevron_right</i>
    @isset($category)
        <a href="{{route('post.category', ['category'=>$category])}}">{{$category->name}}</a>
    @endisset
</div>
