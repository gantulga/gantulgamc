<dropdown-trigger class="h-9 flex items-center" slot-scope="{toggle}" :handle-click="toggle">
    <img src="{{asset('img/'.auth()->user()->avatar)}}?w=32&h=32&fit=crop" class="rounded-full w-8 h-8 mr-3"/>

    <span class="text-90">
        {{ auth()->user()->name }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
