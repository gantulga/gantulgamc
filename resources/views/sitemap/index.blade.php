@extends('layouts.master')

@section('body')
    @include('includes.header')
    <bg-loader class="block-cover" v-slot="{loading}" src="@section('page-header-image') {{asset('img/header-sitemap.jpg')}} @show">
        <div class="container md:flex -mx-3 mx-auto px-4 py-12 pt-24 text-white text-center md:text-left z-10" >
            <div class="w-full md:w-1/5 px-3 mb-8">

            </div>
            <div class="w-full md:w-4/5 px-3 md:pl-12">
                <h1 class=" text-2xl mt-12 uppercase">{{__('Sitemap')}}</h1>
            </div>
        </div>
    </bg-loader>
    <div class="container mx-auto px-4 py-10">
        <div class="md:flex -mx-3">
            <div class="w-full md:w-1/5 px-3 mb-8">

            </div>
            <div class="w-full md:w-4/5 px-3 md:pl-12 mb-8 leading-loose">
                <ul class="text-base w-full leading-normal" >
                        @if($menu)
                            @foreach ($menu['items'] as $item)
                            <li class="mx-0 px-3 mb-4">
                                <a href="{{url($item['url'])}}" class="text-primary font-bold- ">{{$item['name']}}</a>
                                @if($item['items'] && count($item['items']))
                                    <ul class=" mt-4 mb-4 text-sm ">
                                        @foreach (($item['items'] ?? []) as $sub_item)
                                        <li>
                                            <a href="{{url($sub_item['url'])}}">{{$sub_item['name']}}</a>
                                            @if($sub_item['items'] && count($sub_item['items']))
                                                <ul class=" mt-4 mb-4 text-sm ">
                                                    @foreach (($sub_item['items'] ?? []) as $sub_sub_item)
                                                    <li>
                                                        <a href="{{url($sub_sub_item['url'])}}">{{$sub_sub_item['name']}}</a>
                                                        @if($sub_sub_item['items'] && count($sub_sub_item['items']))
                                                            <ul class=" mt-4 mb-4 text-sm ">
                                                                @foreach (($sub_sub_item['items'] ?? []) as $sub_sub_sub_item)
                                                                <li>
                                                                    <a href="{{url($sub_sub_sub_item['url'])}}">{{$sub_sub_sub_item['name']}}</a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endforeach
                        @endif
                    </ul>
            </div>
        </div>
    </div>
    @include('includes.footer',['hideMenu'=>true])
@endsection
