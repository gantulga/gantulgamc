@extends('layouts.default')

 @section('title')
    {{__('News')}}
 @endsection

@section('content')
    <bg-loader class="block-cover bg-center" v-slot="{loading}" src="{{asset('img/slide1.png')}}">
        <div class="container mx-auto px-4 py-12 pt-24 text-white text-center md:text-left z-10" >
            <h1 class=" text-2xl mt-12 uppercase">{{__('News')}}</h1>
        </div>
    </bg-loader>
    <div class="container mx-auto px-4 py-8">
        <div class="md:flex">
            <div class="w-full pt-2 mb-4">
                <?php // $post = $posts->shift(); ?>
                <?php // $post_url = route('post.show', ['id'=>$post->id]) ?>
                {{--
                <div class="w-full md:w-1/2 mb-10 px-3">
                    <a href="{{$post_url}}" class="no-underline text-black">
                        <img src="{{asset('img/'.$post->featuredImage[0]->file??'img/news-default.png')}}?w=640&h=360&fit=crop" class="w-full block" />
                    </a>
                </div>
                <div class="w-full md:w-1/2 mb-10 px-3 flex items-center">
                    <div>
                        <a href="{{$post_url}}" class="no-underline text-black flex-1">
                            <h2 class="text-lg my-2 mb-1">{{$post['title']}}</h2>
                        </a>
                        <span class="text-grey-dark text-xs flex-1">{{ $post['created_at']->toDateString()}}</span>
                        <p class="flex-1">
                            {{ \Illuminate\Support\Str::words( strip_tags($post->content), 100, '...') }}
                        </p>
                    </div>
                </div>
                --}}
                @include('post.includes.posts')
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
