@extends('layouts.default')

 @section('title')
     {{$category->name}} | {{__('News')}}
 @endsection

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
                <h1 class="my-6 text-3xl">{{$category->name}}</h1>
                <div class="pt-2 mb-4">
                    @include('post.includes.posts')
                    {{ $posts->links() }}
                </div>
            </div>
            <div class="w-full md:w-1/4 px-3 md:pl-6  mb-8">
                @include('includes.categories')
            </div>
        </div>
    </div>
@endsection
