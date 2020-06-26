@extends('layouts.default')

 @section('title')
     Мэдээ, мэдээлэл
 @endsection

@section('content')
    <div class="bg-primary">
        <div class="container mx-auto flex px-4 py-6 text-white" >
            <div class="w-2/3">
                <h2 class=" text-2xl uppercase">Мэдээ мэдээлэл</h2>
            </div>
            <div class="w-1/3">
                @include('post.includes.search-form')
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-8">
        <div class="md:flex">
            <div class="w-full pt-2 mb-4">
                <h2 class="mb-6"> "{{$q}}" <span class="text-grey-dark font-normal"> гэх хайлтын үр дүн</span></h2>
                @if(count($posts))
                    <p class="mb-4">Нийт {{count($posts)}} үр дүн олдлоо</p>
                    @include('post.includes.posts')
                @else
                    <p>Үр дүн олдсонгүй</p>
                    <a href="{{route('post')}}" class="btn border border-primary text-primary rounded uppercase py-3 px-3 my-4">← Буцах</a>
                @endif
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
