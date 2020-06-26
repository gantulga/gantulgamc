@extends('layouts.default')

@section('title')“ЭРДЭНЭТ ҮЙЛДВЭР” ТӨҮГ-т ажилд орохыг хүсэгчийн анкет@endsection

@section('content')
    <bg-loader class="block-cover" v-slot="{loading}" src="@section('page-header-image') {{asset('img/header-application.jpg')}} @show">
        <div class="container mx-auto px-4 py-32 text-white text-center md:text-left z-10" >
            @section('header')
            <div class="text-center">
                <h1 class="text-2xl mt-12 uppercase mb">@yield('title')</h1>
            </div>
            @show
        </div>
    </bg-loader>
    <div class="container mx-auto px-4- py-10">
        <div class="relative z-10 bg-white shadow-md border-t-3 border-primary-light w-full md:w-3/4 mx-auto px-8 py-8 -mt-32 mb-20 leading-loose">
            <p class="text-center mb-8 ">
                Ажлын байр: <b>{{$job->position}}</b>
            </p>

            @include('job-application.form-vue')

        </div>
    </div>
@endsection
