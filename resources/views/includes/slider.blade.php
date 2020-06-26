<div id="home-main-slider">
    <carousel :per-page="1"  :mouse-drag="false">
        @for ($i = 0; $i < 3; $i++)
            <slide>
                <div class=" bg-cover w-full text-white" style="background-image: url({{asset('img/slide1.png')}})">
                    <div class="container mx-auto px-4 py-32 text-center md:text-left">
                        <h1 class="bg-secondary inline-block mb-3 mt-32 px-3 py-1 uppercase font-bolder-">Геологи, уул уурхай</h2>
                        <p class="mb-4 md:w-1/3">
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
</div>
