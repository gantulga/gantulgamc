<?php $post_url = route('post.show', ['id'=>$post->id]); ?>
<div class="social-buttons" data-turbolinks-permanent>
    <iframe  allowtransparency="true" frameborder="0" scrolling="no"
        src="https://platform.twitter.com/widgets/tweet_button.html"
        style="width:62px; height:21px;"></iframe>

    <iframe src="//www.facebook.com/plugins/like.php?href={{{ $post_url }}}&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; max-width: 129px;" allowTransparency="true"></iframe>
    {{--
    <div class = "fb-like"
    data-href = "{{$post_url}}"
    data-width = "500"
    data-layout = "standard" data-action = "like"
    data-show-faces = "true"
    data-share = "true"> </div>
    --}}

</div>
{{--

<div id="fb-root" data-turbolinks-permanent></div>

<!-- Your like button code -->

<div class="fb-like" data-href="{{$post_url}}" data-layout="standard" data-share="true" data-action="like" data-show-faces="true">
</div>

--}}
{{--
@section('scripts')
    @parent
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0"></script>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    </script>
@endsection
--}}
