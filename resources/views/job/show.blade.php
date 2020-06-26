@extends('layouts.sidebar-left')

@section('title')
    {{$job->position}} | Нээлттэй ажлын байр
@endsection

@section('page-header-image')
    {{asset('img/header-job-vacancy.jpg')}}
@endsection

@section('header')
    <h1 class=" text-2xl mt-12 uppercase">Нээлттэй ажлын байр</h1>
@endsection

@section('content-inner')
    <h2 class="text-2xl mb-4">{{$job->position}}</h2>
    @include('job.includes.steps')
    <div class="md:flex items-center mb-6">
        <div class="flex-1">
            @if(isset($job->starts_at) || isset($job->expires_at))
                @if(isset($job->starts_at))
                    <div class="flex"><b class="w-1/2 md:w-1/3">Бүртгэл эхлэх хугацаа: </b> &nbsp; {!!$job->starts_at!!}</div>
                @endif
                @if(isset($job->expires_at))
                    <div class="flex"><b class="w-1/2 md:w-1/3">Бүртгэл дуусах хугацаа: </b> &nbsp; {!!$job->expires_at!!}</div>
                @endif
            @endif
        </div>
        <div class="mt-3 md:mt-0">
            @include('job.includes.apply')
        </div>
    </div>
    <div>
        <h3 class="text-primary text-sm font-normal- mb-4 uppercase">Тавигдах шаардлага</h3>
        {!!$job->description!!}
        <hr class="border-t border-grey-light mb-4">
        <h3 class="text-primary text-sm font-normal- mb-4 uppercase">Яаж бүртгүүлэх вэ?</h3>
        {!!$job->props['how_to_apply']!!}

    </div>
    <div class="my-8">
        @include('job.includes.apply')
    </div>
@endsection
