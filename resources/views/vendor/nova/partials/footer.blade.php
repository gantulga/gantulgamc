<p class="mt-8 text-center text-xs text-80">
    <a href="{{ Config::get('nova.url') }}" class="text-primary dim no-underline">{{ Nova::name() }}</a>
    <span class="px-1">&middot;</span>
    &copy; {{ date('Y') }} {{ config('app.name', 'Erdenet MC') }}
    <span class="px-1">&middot;</span>
    v{{ Laravel\Nova\Nova::version() }}
</p>
