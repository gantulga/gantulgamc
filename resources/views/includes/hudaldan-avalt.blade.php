<div class="bg-grey-lightest py-12 bg-no-repeat bg-left-bottom " style="background-image: url({{asset('img/logo-bg.png')}})">

    <scrollbar>
        <div class="container mx-auto px-4 py-6">
            <div class="flex -mx-3">
                <div class="w-3/4 md:w-1/4 flex-none mb-4 px-3">
                    <h3 class="text-2xl uppercase leading-none mb-4">Худалдан <br> авалт</h3>
                    <div class="border-t-5 border-primary mt-4 mb-5 w-2/5" ></div>
                    @include('includes.menu-procurement', ['name'=>'procurement'])
                </div>

                @foreach ($procurements as $i => $proc)
                    <div class="w-full md:w-1/4 flex-none mb-4 px-3 flex {{$i<4?'reveal-left-no-mobile':''}}">
                        <div class="bg-white shadow-lg p-6 flex flex-col border-primary border-t-2">
                            <a href="{{url('procurement')}}" class="no-underline text-black flex-initial">
                                <h3 class="leading-tight mb-4"> {{$proc->name}} </h3>
                            </a>
                            <p class=" text-2xs text-grey-dark flex-grow">{{ \Illuminate\Support\Str::words( strip_tags($proc->description), 20, '...') }}</p>
                            <div class="border-t-2 border-grey h-1 my-3 w-1/4 flex-initial" ></div>
                            <div class="flex flex-initial">
                                <div class="text-grey-dark text-xs w-1/2">
                                    Зарласан огноо <br>
                                    <span class="font-black">{{$proc->start_date->toDateString()}}</span>
                                </div>
                                <div class="text-black text-xs w-1/2">
                                    Дуусах огноо <br>
                                    <span class="font-bold">{{$proc->end_date->toDateString()}}</span>
                                </div>
                            </div>
                            <div class="-mb-10 mt-4 flex-initial">
                                @include('components.read-more',['url' => url('procurement')])
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </scrollbar>

</div>
