@extends('layouts.sidebar-left')

@section('title')
    Худалдан авалт
@endsection

@section('page-header-image')
    {{asset('img/header-procurement.jpg')}}
@endsection

@section('content-inner')
    @if($procurements->count())
        <div class="hidden md:block md:flex border-primary border-b-2 bg-white mb-6 text-grey-dark text-xs font-bold">
            <div class="md:w-1/6">
                <div class="px-6 mb-5 ">
                Огноо:
                </div>
            </div>
            <div class="md:w-2/5">
                <div class="px-6 pb-5 ">
                Шалгаруулалтын нэр:
                </div>
            </div>
            <div class="md:w-2/5 flex-grow">
                <div class="px-6 mb-5 ">
                    Товч тайлбар
                </div>
            </div>
        </div>
        <accordion>
            @foreach ($procurements as $proc)
                <accordion-panel class="shadow-lg mb-8 text-grey-dark" :key="{{$proc->id}}">
                    <template v-slot:header="{ toggle, isOpen }">
                        <div class="md:flex border-primary border-t-2 bg-white ">
                            <div class="md:w-1/6 flex border-grey-lighter border-b md:border-b-0">
                                <div class="px-6 my-2 mt-4 md:my-5 border-grey md:border-r flex md:flex-col flex-grow text-center md:text-left">
                                    <div class="w-1/2 md:w-full">
                                        <span class="text-xs">Зарласан огноо</span>
                                        <h4 class="mb-2 md:text-base text-black">{{$proc->start_date->toDateString()}}</h4>
                                    </div>
                                    <div class="w-1/2 md:w-full">
                                        <span class="text-xs">Дуусах огноо</span>
                                        <p class="text-secondary md:text-xs font-bold">{{$proc->end_date->toDateString()}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-2/5 flex">
                                <div class="px-6 my-2 mt-4 md:my-5 ">
                                    <h3 class="text-black">{{$proc->name}}</h3>
                                </div>
                            </div>
                            <div class="md:w-2/5 flex flex-grow relative">
                                <div class="px-6 my-2 md:my-5 border-grey md:border-l text-xs" :class="!isOpen?'pb-6':''">
                                    {{ \Illuminate\Support\Str::words( strip_tags($proc->description), 20, '...') }}

                                        <div v-if="!isOpen" class="absolute pin-b pin-r -mb-4 flex-initial text-sm text-right">
                                            <button @click="toggle" class="btn btn-primary px-1 pl-3 mx-4 mr-6" >
                                                <div class="flex items-center">
                                                    <span style="margin-bottom:0.1rem">дэлгэрэнгүй</span>
                                                    <i class="material-icons ml-1">chevron_right</i>
                                                </div>
                                            </button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-slot:default="{ toggle, isOpen }">
                        <hr class="mx-6 mt-0 border-t border-grey">
                        <div class="relative px-6 pt-2 pb-5 text-xs">
                            <div class="mb-8">
                                {!! $proc->description !!}
                            </div>
                            @if(isset($proc->props['documents']))
                                <div class="mb-8">
                                    <hr class="border-t border-grey -mb-6">
                                    <h4 class="my-3 text-sm text-black">
                                        <span class="bg-white pr-3">Бараа нийлүүлэх үнийн саналд хавсаргах бичиг баримт:</span>
                                    </h4>
                                    {!! $proc->props['documents'] !!}
                                </div>
                            @endif

                            @if(isset($proc->props['contract_term']))
                                <div class="mb-8">
                                    <hr class="border-t border-grey -mb-6">
                                    <h4 class="my-3 text-sm text-black">
                                        <span class="bg-white pr-3">Гэрээний нөхцөл:</span>
                                    </h4>
                                    {!! $proc->props['contract_term'] !!}
                                </div>
                            @endif

                            @if(isset($proc->props['winner_info']))
                                <div class="mb-8">
                                    <hr class="border-t border-grey -mb-6">
                                    <h4 class="my-3 text-sm text-black">
                                        <span class="bg-white pr-3">Шалгарсан компаний мэдээлэл:</span>
                                    </h4>
                                    {!! $proc->props['winner_info'] !!}
                                </div>
                            @endif
                            {{--
                            <div class="mb-8">
                                <hr class="border-t border-grey -mb-6">
                                <h4 class="my-3 text-sm text-black">
                                    <span class="bg-white pr-3">Холбоо барих:</span>
                                </h4>
                                <div class="md:flex flex-wrap my-4">
                                    <div class="md:w-1/3">
                                        <div class="flex items-center mb-4">
                                            @if($proc->user->avatar)
                                                <img src="{{asset('img/'.$proc->user->avatar)}}?w=58&h=58&fit=crop" class="rounded-full mr-4"/>
                                            @endif
                                            <div>
                                                <span class="block text-grey-dark text-xs"> {{ $proc->user->props['position'] }} </span>
                                                <span class="block text-black font-bold text-sm"> {{ $proc->user->name }} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:w-2/3 flex items-center flex-wrap text-black font-bold text-sm justify-between">
                                        <span class="flex items-center mb-4">
                                            <i class="material-icons text-primary mr-2">mail</i>
                                             {{ $proc->user->email }}
                                        </span>
                                        <span class="flex items-center mb-4">
                                            <i class="material-icons text-primary mr-2">phone</i>
                                             {{ $proc->user->props['office_phone'] }}
                                        </span>
                                        <span class="flex items-center mb-4">
                                            <i class="material-icons text-primary mr-2">phone_iphone</i>
                                             {{ $proc->user->props['phone'] }}
                                        </span>
                                        <span class="flex items-top mb-4">
                                            <i class="material-icons text-primary mr-2">place</i>
                                            <p class=" font-normal text-xs"> {{ $proc->user->props['address'] }} <p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            --}}
                            @if(isset($proc->props['sanamj']))
                                <div class="bg-yellow-lightest-70 -mx-6 -mb-5 px-6 py-4 pb-8 text-black">
                                    <h4 class="mb-2 text-sm">Холбоо барих</h4>
                                    {!! $proc->props['sanamj'] !!}
                                </div>
                            @endif

                            <div v-if="isOpen" class="absolute pin-b pin-r flex-initial text-sm text-right -mb-4">
                                <a href="javascript:void(0);" @click="toggle" class="btn btn-primary px-1 mx-4 mr-6">
                                    <div class="flex items-center">
                                        <span class="px-6 ml-4">Хаах</span>
                                        <i class="material-icons ">expand_less</i>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </template>
                </accordion-panel>

            @endforeach
        </accordion>
        {{ $procurements->links() }}
    @else
        @include('includes.no-result')
    @endif
@endsection

