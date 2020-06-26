<?php
$class = '';
switch ($col ?? 4) {
    case 1:
        $class = 'w-full';
        break;
    case 2:
        $class = 'w-full md:w-1/4';
        break;
    case 3:
        $class = 'w-1/2 md:w-1/3';
        break;
    default:
        $class = 'w-1/2 md:w-1/4';
        break;
}

?>
<div class="flex flex-wrap -mx-3">
@foreach ($posts as $post)
    <?php
    $post_url = route('post.show', ['id'=>$post->id]);
    $featuredImage = isset($post->featuredImage) && count($post->featuredImage) ? $post->featuredImage[0]->file : 'img/news-default.png';
    ?>
    <div class="{{$class}} mb-4 px-3">
        <a href="{{$post_url}}" class="no-underline text-black">
            <!--img src="{{asset('img/'.$featuredImage)}}?w=270&h=180&fit=crop" class="w-full" /-->
            <image-loader src="{{asset('img/'.$featuredImage)}}?w=270&h=180&fit=crop" class="w-full"></image-loader>
            <h3 class="text-sm my-2 mb-1">
                @if(isset($post['props']['icon']))
                    <i class="{{$post['props']['icon'] }} mr-1 text-grey-dark"> </i>
                @endif
                {{$post['title']}}
            </h3>
        </a>
        <span class="text-grey-dark text-xs">{{ $post['created_at']->toDateString()}}</span>
    </div>
@endforeach
</div>
