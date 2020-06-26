@extends('layouts.sidebar-left')

@section('title')
    Тендерийн үр дүн
@endsection

@section('page-header-image')
    {{asset('img/header-procurement-result.jpg')}}
@endsection

@section('content-inner')
    @if($result->exists)
        <h2 class="text-2xl mb-4">{{$result->title}}</h2>
        <hr class="border-t border-grey-light mb-4">
        <div class="mb-4">
            {!!$result->description!!}
        </div>

        @if(isset($result['attachment']))
            <div class="block text-center">
                <p class=" font-bold mb-4">Файл татах:</p>
                <a class=" text-center inline-block" href="{{asset($result['attachment'])}}">
                    <image-loader src="{{asset(fileThumbnailUrl($result->attachment))}}?w=180&h=180&fit=crop" class="w-full px-4 py-2"></image-loader>
                    <span class="flex items-center">
                        <i class="material-icons mr-2"> save_alt </i>
                        {{$result['attachment_name']}}
                    </span>
                </a>
            </div>
        @endif
    @elseif($results->count())
        <div class="flex border-primary border-b-2 bg-white mb-6 text-grey-dark text-xs font-bold">
            <p class="mb-4">"Эрдэнэт үйлдвэр" ТӨҮГ-ын худалдан авах ажиллагааны ил тод байдлын мэдээлэл</p>
        </div>
        @foreach ($results as $result)
            <div class="w-1/2 md:w-1/4 mb-10 px-3">
                <a href="{{route('procurement.result.show', ['result'=>$result])}}" class="no-underline text-black">
                    <image-loader src="{{asset(fileThumbnailUrl($result->attachment))}}?w=180&h=180&fit=crop" class="w-full px-4 py-2 border border-grey-light rounded"></image-loader>
                    <h3 class="text-sm my-2 mb-1">{{$result->title}}</h3>
                </a>
                <span class="text-grey-dark text-xs">{{ $result['created_at']->toDateString()}}</span>
            </div>
        @endforeach
        {{ $results->links() }}
    @else
        @include('includes.no-result')
    @endif
@endsection

