<header class="bg-white leading-none" :class="{'sticky pin-t z-50 shadow-md':isNavbarSticky}">
    <div class="container md:flex md:justify-between mx-auto px-4 pt-2-">
        <div class="flex items-center">
            <a href="{{LaravelLocalization::localizeUrl('/')}}" class="flex-grow my-4 md:my-0"><img class="w-64" src="{{asset('img/logo.svg')}}" alt="Erdenet MC"/></a>
            <a @click="toggleMainMenu" href="javascript:void(0)" class="md:hidden btn border border-primary rounded p-1 py-0 ml-6 flex"> <i class="material-icons text-4xl text-primary">menu</i> </a>
        </div>
        <div  class="md:flex md:flex-col md:justify-between hidden md:visible mb-8 md:mb-0" ref="mainMenu">
            @include('includes.menu-top', ['name'=>'top'])
            @include('includes.menu-main', ['name'=>'main'])
        </div>
    </div>
</header>
<div v-if="showSearch" id="search-box">
    <search-box id="search" action="/search" input="q" @close="showSearch = false" placeholder="{{__('Хайх')}}"></search-box>
</div>
