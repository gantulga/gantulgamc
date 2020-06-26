@extends('layouts.default')

@section('title'){{$post->title}} | {{__('News')}}@endsection

@section('content')
    <div class="bg-primary">
        <div class="container mx-auto flex px-4 py-6 text-white" >
            <div class="w-2/3">
                <h2 class=" text-2xl uppercase">{{__('News')}}</h2>
            </div>
            <div class="w-1/3">
                @include('post.includes.search-form')
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-8">
        <div class="md:flex -mx-3">
            <div class="w-full md:w-3/4 px-3 mb-4">
                @include('post.includes.breadcrumb')
                <h1 class="my-6 mb-2 text-3xl">{{$post->title}}</h1>
                @include('post.includes.meta')
                <div class="text-base mb-12 leading-loose">
                    @if(count($post->featuredImage))
                        <figure class="mb-4">
                            <image-loader src="{{asset('storage/'.$post->featuredImage[0]->file)}}" class="block w-full"></image-loader>
                            @if(isset($attr['caption']))
                                <figcaption>{{$post->featuredImage[0]['description']}}</figcaption>
                            @endif
                        </figure>
                    @endif
                    {!!$post->content!!}
                    @include('blocks.index', ['blocks'=>$post->props['blocks']])
                </div>
                @include('post.includes.social')
                @include('post.includes.related-posts')
                @include('post.comment.list')
            </div>
            <div class="w-full md:w-1/4 px-3 md:pl-6  mb-8">
                @include('includes.categories')
                @include('post.includes.posts')
            </div>
        </div>
    </div>
@endsection
