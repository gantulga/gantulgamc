@if($post->relatedPosts->count())
    <h4 class="py-4 border-t border-grey-lighter text-lg">Холбоотой мэдээнүүд<h4>
    @include('post.includes.posts', ['posts'=>$post->relatedPosts, 'col'=>4])
@endif
