<div class="flex mb-4 text-xs text-grey-dark">
    <div class="mr-4">
        <i class="material-icons text-xs align-middle">access_time</i>
        <span class="align-middle">{{{ $post->created_at->toDateString() }}}</span>
    </div>
    <div>
        <i class="material-icons text-xs align-middle">label</i>
        @foreach ($post->categories as $i => $cat)
            <a class="align-middle text-primary-dark mr-2" href="{{route('post.category', ['category'=>$cat])}}">{{$cat->name}}</a>
        @endforeach
    </div>
</div>
