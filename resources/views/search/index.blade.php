@extends('layouts.default')

 @section('title')
     Хайлт
 @endsection

@section('content')
    <div class="bg-primary">
        <div class="container mx-auto px-4 flex py-8 text-white" >
            <div class="md:w-1/5 flex items-center">
                <h2 class=" text-2xl uppercase mr-4">Хайлт</h2>
            </div>
            <div class="flex-1 flex flex-col">
                @include('search.includes.search-form')
            </div>
            <div class="md:w-1/5"></div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-8 md:flex">

            <div class="md:w-1/5">
            </div>
            <div class="md:w-4/5 mb-4">
                @if($results ?? false)
                    <h3 class="mb-3"> "{{$search}}" <span class="text-grey-dark font-normal"> гэх хайлтын үр дүн</span></h3>
                    @if(count($results))
                        <p class="mb-8 text-grey-dark"><i>Нийт {{$count}} үр дүн олдлоо</i></p>
                        @foreach ($results as $result)
                            <div class="mb-4">
                                <a href="{{url($result->link)}}">
                                    <h4 class="text-lg text-primary-dark">{{$result->title}}</h4>
                                </a>
                                <p class=" text-grey-darkest">
                                    {!! \Illuminate\Support\Str::words($result->content, 40) !!}
                                </p>
                            </div>
                        @endforeach
                        {{ $results->appends(['q' => $search])->links() }}
                    @else
                        <p class="mb-8 text-grey-dark"><i>{{__('Үр дүн олдсонгүй')}}</i></p>
                        <a href="{{url()->previous()}}" class="btn text-primary py-3 my-4">← Буцах</a>
                    @endif
                @else

                @endif
        </div>
    </div>
@endsection
