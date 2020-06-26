<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @section('head')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @section('title-tag')<title>@hasSection ('title')@yield('title') | @endif{{ config('app.name', 'Erdenet MC') }}</title>@show

        @include('includes.social-meta')
        @include('feed::links')
    @show

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    @section('styles')
        <link href="{{mix('css/app.css') }}" rel="stylesheet" data-turbolinks-track="reload">
    @show

    {{--<script src="https://unpkg.com/scrollreveal@4.0.5/dist/scrollreveal.min.js"></script>--}}
    {{--<script type="text/javascript" src="{{mix('js/scrollreveal.js')}}"></script>--}}
    <!--meta name="turbolinks-cache-control" content="no-cache"-->
    <script type="text/javascript" src="{{mix('js/app.js')}}" data-turbolinks-track="reload"></script>
    @if($ga=settings('google_analytics_script'))
        <script>
            {!! $ga !!}
        </script>
    @endif
</head>
<body class="antialiased font-sans font-normal leading-normal text-sm text-grey-darkest">
    <div id="app">
        @yield('body')
        <vue-progress-bar data-turbolinks-permanent></vue-progress-bar>
    </div>
    @section('scripts')

    @show
</body>
</html>
