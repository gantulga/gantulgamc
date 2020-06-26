@extends('layouts.sidebar-left')

 @section('title')
    Компаний бүртгэл
 @endsection


@section('content-inner')
<div id="companyRegister" class="text-center p-18 py-12">

    <div class="inline-block mt-24-">
        <div class=" border border-primary rounded-full  mb-4 flex flex-auto items-center justify-center">
            <i class="material-icons text-5xl p-5 text-primary">mail</i>
        </div>
    </div>
    <h3 class="mb-8">Амжилттай бүртгэгдлээ.</h3>
    <p class="my-8 font-bold">
        <span class="text-primary ">
            {{auth()->user()->email}}
        </span>
        хаяг руу бүртгэл баталгаажуулах холбоос явуулсан.
        <br>Уг холбоосоор орж имэйл-ээ баталгаажуулна уу.
    </p>
    <p>Хэрэв имэйл хүлээж аваагүй бол <a href="{{ route('company.verification.resend') }}" class="no-underline hover:underline text-primary">энд дарж дахиад илгээнэ үү</a>.</p>
</div>
@endsection
