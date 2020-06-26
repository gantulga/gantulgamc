@extends('layouts.default')

@section('content')
    <!--div class="bg-center bg-cover " style="background-image:url(@section('page-header-image') {{asset('img/page-header-default.png')}} @show)"-->
    <bg-loader class="block-cover" v-slot="{loading}" src="@section('page-header-image') {{asset('img/page-header-default.png')}} @show">
        <div class="container mx-auto px-4 py-12 pt-24 text-white text-center md:text-left z-10" >
            @section('header')
                <h1 class=" text-2xl mt-12 uppercase">@yield('title')</h1>
            @show
        </div>
    </bg-loader>
    <!--/div-->
    <div class="container mx-auto px-4 py-10">
        <div class="md:flex -mx-3">
            <div class="w-full md:w-1/4 px-3 mb-8">
                @section('sidebar')
                    @include('includes.menu-sidebar', ['name'=>'sidebar'])
                @show
            </div>
            <div class="content-inner w-full md:w-3/4 px-3 md:pl-12 mb-8 leading-loose">
                @yield('content-inner')
            </div>
        </div>
    </div>
@endsection
