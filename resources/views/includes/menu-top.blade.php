<ul v-if="showTopBar" class="hidden md:block md:flex md:items-center md:justify-end pt-4 mb-0 list-reset text-2xs">

    <li class="ml-2"><a class="no-underline" href="{{LaravelLocalization::localizeUrl('/sitemap')}}">{{__('Sitemap')}}</a></li>
    <li class="ml-2">|</li>
    <li class="ml-2"><a class="no-underline" href="{{LaravelLocalization::localizeUrl('/contact')}}"> {{__('Contact Us')}}</a></li>
    <li class="ml-2">|</li>
    <li class="ml-2">
        <a @click="toggleSearch" class="pointer">
            <i class="material-icons text-lg" style="cursor: pointer;">search</i>
        </a>
    </li>
    <li class="ml-2 -my-3">
        <a href="{{ LaravelLocalization::getLocalizedURL('mn') }}">
            <img class="w-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAABiklEQVRYw+2XPS9EQRSGnzP33l0bYn1FKEREISoKtVKnUvgLlmj9ERGVHyCi8g90KoVSRBCJQtb37t6PmaPYRFiKbeausKecTM48Oe95Z86IqtLJMHQ4ugBdgBDgYmyiLSts7B61lXSnstzWvum7G/m9EmgGaKcAMijMOKTkH+I7gAXpVwa3GhTnMjTOG0BAYyG7NrgH8e6Tb+ldTehdSilXEsprCdg8ARSkCGZQyW4NqmCGFTLP98DXEoC9M9SPA9LzABIByaEC7k3oW0kZP3gjvTKQQXxmGNiMGd2uo9Z3BRwEI0ph1tGzYLGPQjTtKM5bTFm92dG0WlBroAmEY4qrCvZBvDZi2NKDoNC3mmKKUF5P0JqgqeQDIAABPO8VKC1m2KoQTTjCSZeTDQ1ICNGUQ0pN3YMh9WmCTwACWhPsvdA4CUAgOQtILw3uKQcJTK/ysh/xchjiXoX4tIRaqB+HH5Xx2wMCmgKJNA9TkKjpCNTf7BS2PkQfgssPa39xJpTuz6gL8O8B3gE6yY0xkxQ8awAAAABJRU5ErkJggg==" />
        </a>
    </li>
    <li class="ml-2 -my-3">
        <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">
            <img class="w-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAByElEQVRYw+2WvUvDUBTFA04u7VTo0sGpf4Ao1L2L4FApdHN01slBcFIEJ0EcFDqqFaGubkJdtIhVKWhBobjZwc5+NMeeSNI0vOTdpmId8uBt7+N3Ts69LwYAY5TTiAAigH8B8Fwo4LPVwvtHB6u7VYxN7cOY3AucpgnU4nFcW0cAqdkD7Z7FjQpeNrdwn0rhrVSCA9BcWsZtIoF2uWwddlV/RXr++NcAJuYOcX5SwUMmg6dczhL71TF7ALysenSGejoNqRtSAIVqPDbbmF447QFwIS9a276A1A0dgJ/q9eINxmeK1po+AHv2uZHP+7oRBBCk2n2XEkDqhgpAoloEIHHDC7CycylSPRCA1427ZNJxg8MN0MhmRaqVAAg53AAhxw9ALRazDvrr6QCM4nKKHvoTWAd1P0OYYZqQhZBBYqAYLAaMQWPgVAAMKIPKwDK4ujdFC8ASYilxsLRYYiw1lpwXgKXJEiUkS5alyxIOelN8AVSq2VzYZNhs2HS8AHbfYLOy3WATC3JDCeCnmu3VXuMHYPcNqRt9ADrV7o1BAO4uqnPDAZCoHhRA6Ub3qXe74QBIVIcB0LnhAEhUDwPg50b0VxwBRACc37+H2GuakEPwAAAAAElFTkSuQmCC" />
        </a>
    </li>
    {{--
    <li class="ml-2 -my-3">
        <a href="#">
            <img class="w-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAOElEQVRYw+3WsQ0AIAACMP5/GmM8AoeSwNyRtM2yAQD4BbAKAADAA9xdFADgH0B3AgAAAK8YACAHuihBWvimU3sAAAAASUVORK5CYII=" />
        </a>
    </li>
    --}}
</ul>
