@extends('layouts.default')

@section('title')
    {{ __('Page not found') }}
@endsection

@section('content')
    <section class="container mx-auto px-4 flex">
        <div class="md:w-1/4">
        </div>
        <div class="px-4 py-24 md:pl-12 md:w-3/4 text-center md:text-left">
            <h1 class="text-5xl text-primary border-b border-primary mb-4" style="font-size: 8rem; line-height:4rem">
                404
                <span class=" text-2xl mb-10 text-grey-dark">{{ __($exception->getMessage() ?: 'Page not found') }}</span>
            </h1>
            <a href="{{url('/')}}" class="btn border border-primary text-primary rounded uppercase py-3 px-3">← {{__('Back')}}</a>
        </div>
    </section>
@endsection
