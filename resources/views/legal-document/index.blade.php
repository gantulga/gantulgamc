@extends('layouts.sidebar-left')

@section('title')
    Хууль журам
@endsection

@section('header')
    <h1 class=" text-2xl mt-12 uppercase"><a class="text-white" href="{{route('legal-document.index')}}">Хууль журам</a></h1>
@endsection

@section('page-header-image')
    {{asset('img/header-law.jpg')}}
@endsection

@section('content-inner')
    @if(isset($category))
        <h2 class="text-2xl mb-4">{{$category->name}}</h2>
        <hr class="border-t border-grey-light mb-4">
    @endif
    @foreach ($documents as $i => $doc)
    <div class="w-full border-grey-lighter mb-4 pb-4 {{ count($documents) > $i+1 ? 'border-b':'' }}">
        <a href="{{route('legal-document.show', ['legalDocument' => $doc])}}" class="text-lg block mb-2-">
            {{$doc['name']}}
        </a>
        <p class="text-grey-dark">
            {{$doc['created_at']->toDateString()}}
        </p>
    </div>
    @endforeach
    {{ $documents->links() }}
@endsection

@section('sidebar')
    @include('legal-document.categories')
@endsection
