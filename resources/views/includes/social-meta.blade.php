<?php
$post = $post ?? $page ?? null;
?>

@section('social-meta-tags')
    {{--  Essential META Tags --}}

    {{-- Title --}}
    <meta property="og:title" content="@yield('title') " />

    {{-- Description --}}
    @hasSection ('description')
        <meta property="og:description" content="@yield('description')" />
    @elseif($post && $post['description'])
        <meta property="og:description" content="{{$post['description']}}" />
    @endif

    {{-- Image --}}
    @hasSection ('featured-image')
    <meta property="og:image" content="@yield('featured-image')" />
    <meta property="og:image:url" content="@yield('featured-image')" />
    @elseif($post && isset($post->featuredImage[0]))
    <meta property="og:image" content="{{asset('img/'.$post->featuredImage[0]->file)}}?w=1200&h=630&fit=crop" />
    <meta property="og:image:url" content="{{asset('img/'.$post->featuredImage[0]->file)}}?w=1200&h=630&fit=crop" />
    @endif
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    {{-- Other --}}
    <meta property="og:url" content="{{ URL::current() }}" />
    <meta name="twitter:card" content="summary_large_image" />

    {{--  Non-Essential, But Recommended --}}
    <meta property="og:site_name" content="{{ config('app.name', 'Erdenet MC') }}" />
    {{-- <meta name="twitter:image:alt" content="Alt text for image" /> --}}


    {{--  Non-Essential, But Required for Analytics --}}
    <meta property="fb:app_id" content="524960918092031" />
    {{--
        <meta name="twitter:site" content="@website-username">
    --}}
@show
