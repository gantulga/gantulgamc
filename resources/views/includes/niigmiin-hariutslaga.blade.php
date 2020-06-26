<div class="container mx-auto px-4 py-8 pb-10 hidden md:block">
    <h3 class="text-base uppercase mb-4">Нийгмийн <span class="ml-2 text-primary">хариуцлага</span></h3>

    <div id="niigmiin-hariutslaga">
        <vertical-tabs>
            <tab name="Бүтээн байгуулалт"  >
                    <carousel :per-page="1"  :mouse-drag="false" :pagination-enabled="true">
                            @for ($i = 0; $i < 3; $i++)
                            <slide>
                                <div class="bg-cover flex w-full text-white" style="background-image: url({{asset('img/eruul-mend@2x.png')}})">
                                    <div class="p-8 px-10 w-full text-center md:text-left bg-gradient-t-darker-dark">
                                        <h2 class="mb-3 mt-32 uppercase font-bolder text-3xl">Эрүүл мэнд</h2>
                                        <p class="mb-4 md:w-1/3 text-xs">
                                            бүтээн байгуулалтын түүхийн эзэд нэгэн дор
                                            цуглаж, Эрдэнэт үйлдвэрийн 40 жилийн түүхийг
                                            Нийслэл хотод сөхлөө
                                        </p>
                                        @include('components.read-more',['url'=>'/'])
                                    </div>
                                </div>
                            </slide>
                            @endfor
                        </carousel>
            </tab>
            <tab name="Эрүүл мэнд" :selected="true" bg="{{asset('img/tab-bg.png')}}">
                <carousel :per-page="1"  :mouse-drag="false" :pagination-enabled="true">
                    @for ($i = 0; $i < 3; $i++)
                    <slide>
                        <div class="bg-cover flex w-full text-white" style="background-image: url({{asset('img/eruul-mend@2x.png')}})">
                            <div class="p-8 px-10 w-full text-center md:text-left bg-gradient-t-darker-dark">
                                <h2 class="mb-3 mt-32 uppercase font-bolder text-3xl">Эрүүл мэнд</h2>
                                <p class="mb-4 md:w-1/3 text-xs">
                                    бүтээн байгуулалтын түүхийн эзэд нэгэн дор
                                    цуглаж, Эрдэнэт үйлдвэрийн 40 жилийн түүхийг
                                    Нийслэл хотод сөхлөө
                                </p>
                                @include('components.read-more',['url'=>'/'])
                            </div>
                        </div>
                    </slide>
                    @endfor
                </carousel>
            </tab>
            <tab name="Спорт">
Спорт
            </tab>
            <tab name="Соёл амралт">
Соёл амралт
            </tab>
            <tab name="Боловсрол">
Боловсрол
            </tab>
        </vertical-tabs>

    </div>
</div>
