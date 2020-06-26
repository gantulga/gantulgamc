@extends('layouts.default')

@section('content')
    @include('includes.slider')
    @include('includes.statistic')
    @include('includes.medee')
    @include('includes.hudaldan-avalt')
    @include('includes.niigmiin-hariutslaga')
    @include('includes.virtual-tour')
    <div class="container mx-auto px-4">
        <div class="md:flex -mx-3">
            @include('includes.ajliin-bair')
            @include('includes.durem-juram')
        </div>
    </div>
    @include('includes.album')
    @include('includes.hansh')
@endsection
