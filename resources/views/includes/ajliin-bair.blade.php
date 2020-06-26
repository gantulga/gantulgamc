<div class="w-full mt-4 mb-10">
    <div class="flex">
        <div class="w-full md:w-3/5 p-8 shadow-lg leading-tight">
            <div class="md:flex w-full">
                <span class="text-5xl py-0 pt-0 text-primary" style="font-size: 4.4375rem; line-height: 1;">{{$count}}</span>
                <a href="{{route('job.index')}}" class="block leading-tight p-5 text-primary text-base font-bold w-3/4">Нээлттэй<br>ажлын байр</a>
            </div>

            @foreach ($jobs as $job)
                <div class="w-full border-b border-grey-lighter pt-4 pb-2">
                    <a href="{{route('job.show', ['job' => $job->id36()])}}" class="no-underline text-grey-dark font-bold text-xs block mb-2">
                        {{$job['position']}}
                    </a>
                    <p class="text-primary text-2xs mb-2">
                        {{$job['count']}} ажлын байр
                        @if($job['type']){{ '/' . $job['type'] . '/' }}@endif
                    </p>
                </div>
            @endforeach

            <div class="-mb-12 mt-4 flex-initial text-right">
                @include('components.read-more',['url'=>route('job.index'), 'text'=>'Бүх ажлын зар'])
            </div>
        </div>
        <div class="hidden md:block md:w-2/5 p-8 pr-4 bg-primary bg-no-repeat bg-left-bottom text-white" style="background-image: url({{asset('img/job-bg.png')}})">
            @include('includes.menu-hr', ['name'=>'hr'])
            {{--
                <ul class="list-reset -mt-3 no-underline text-xs font-bold">
                    <li class="my-3"><a class="text-white" href="#"> Хүний нөөцийн бодлого </a> </li>
                    <li class="my-3"><a class="text-white" href="#"> Нээлттэй ажлын байр </a> </li>
                    <li class="my-3"><a class="text-white" href="#"> Хамтын гэрээний хэрэгжилт </a> </li>
                    <li class="my-3"><a class="text-white" href="#"> Хөдөлмөрийн баатрууд </a> </li>
                    <li class="my-3"><a class="text-white" href="#"> Гавъяат ажилтнууд </a> </li>
                    <li class="my-3"><a class="text-white" href="#"> Хөдөлмөрийн аваргууд </a> </li>
                    <li class="my-3"><a class="text-white" href="#"> Хөдөлмөрийн алдартнууд </a> </li>
                </ul>
            --}}
        </div>

    </div>
</div>
