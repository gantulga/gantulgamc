@if($post->commentable)
    <?php
    $comments = $post->comments()->approved()->latest()->simplePaginate(50);
    ?>
    <div id="comments">
        @include('post.comment.form')
        <ul class="list-reset">
            @foreach ($comments as $comment)
                <li id="comment-{{$comment->id}}" class="mb-4">
                    <b class="font-bold">{{ isset($comment->user) ? $comment->user->name : $comment->name }}</b>
                    &middot;
                    <span class="text-xs text-grey">{{$comment->created_at->toDateString()}}</span>
                    <p>{{$comment->text}}</p>
                </li>
            @endforeach
        </ul>
        {{$comments->links()}}
    </div>
@endif
