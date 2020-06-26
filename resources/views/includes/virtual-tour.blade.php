<div class="relative mt-8 mb-16 text-center" data-turbolinks="false">
    <a href="/virtualtour/index.html">
        <image-loader class="w-full"  src="{{asset('img/virtual-tour.jpg')}}"></image-loader>
    </a>
    <div class="absolute pin-b -mb-5 w-full">
        @include('components.read-more', ['text'=>'<b>VIRTUAL TOUR</b>', 'url'=>'/virtualtour/index.html', 'class'=> 'py-2 pl-10 pr-6 text-base'])
    </div>
</div>
