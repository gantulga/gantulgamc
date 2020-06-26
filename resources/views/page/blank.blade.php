@extends('layouts.default')

@section('title'){{$page->title}}@endsection

@section('content')
    {{-- htmlspecialchars(json_encode($page->props['blocks'])) --}}
    @include('blocks.index', ['blocks'=>$page->props['blocks']])
@endsection
