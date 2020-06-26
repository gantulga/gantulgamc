@extends('layouts.sidebar-left')

@section('title'){{$form->title}}@endsection

@section('content-inner')
    <div class="md:w-4/5">
        @include('form.form', ['form'=>$form])
    </div>
@endsection
