@extends('layouts.sidebar-left')

@section('title'){{$page->title}}@endsection

@isset($page->featuredImage[0]->file)
    @section('page-header-image')
        {{asset('storage/'.$page->featuredImage[0]->file)}}
    @endsection
@endisset


@section('content-inner')
    @include('blocks.index', ['blocks'=>$page->props['blocks']])
@endsection
