@extends('layouts.sidebar-left')

@section('title')
    {{$document->name}} | Хууль журам
@endsection

@section('header')
    <h1 class=" text-2xl mt-12 uppercase"><a class="text-white" href="{{route('legal-document.index')}}">Хууль журам</a></h1>
@endsection

@section('page-header-image')
    {{asset('img/header-law.jpg')}}
@endsection

@section('content-inner')
    <h2 class="text-2xl mb-4">{{$document->name}}</h2>
    <hr class="border-t border-grey-light mb-4">
    <div class="mb-4">
        {!!$document->description!!}
    </div>

    @if(isset($document['file']))
        <div class="inline-block">
            <p class=" font-bold mb-2">Файл татах:</p>
            <a class="btn btn-primary rounded-sm px-4 py-2 flex items-center" href="{{asset('storage/'.$document['file'])}}">
                <i class="material-icons mr-2"> save_alt </i>
                {{$document['file_name']}}
            </a>
        </div>
    @endif

@endsection

@section('sidebar')
    @include('legal-document.categories')
@endsection
