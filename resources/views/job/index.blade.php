@extends('layouts.sidebar-left')

@section('title')
    Нээлттэй ажлын байр
@endsection

@section('page-header-image')
    {{asset('img/header-job-vacancy.jpg')}}
@endsection

@section('header')
    <h1 class=" text-2xl mt-12 uppercase">Нээлттэй ажлын байр</h1>
@endsection

@section('content-inner')

    @foreach ($jobs as $i => $job)
    <div class="w-full border-grey-lighter mb-4 pb-4 {{ count($jobs) > $i+1 ? 'border-b':'' }}">
        <a href="{{route('job.show', ['job' => $job->id36()])}}" class="text-lg block mb-2-">
            {{$job['position']}}
        </a>
        <p class="text-primary">
            {{$job['count']}} ажлын байр
            @if($job['type']){{ '/' . $job['type'] . '/' }}@endif
        </p>
        @if(isset($job->starts_at) || isset($job->expires_at))
            @if(isset($job->starts_at))
            <span class="mr-4"><i class="text-grey-dark">Бүртгэл эхлэх: </i> &nbsp; {!!$job->starts_at!!}</span>
            @endif
            @if(isset($job->expires_at))
            <span><i class="text-grey-dark">Бүртгэл дуусах: </i> &nbsp; {!!$job->expires_at!!}</span>
            @endif
        @endif
    </div>
    @endforeach
    {{ $jobs->links() }}
@endsection
