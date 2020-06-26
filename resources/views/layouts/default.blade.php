@extends('layouts.master')

@section('body')
    @include('includes.header')
    <div id="content">
        @yield('content')
    </div>
    @include('includes.footer')
@endsection
