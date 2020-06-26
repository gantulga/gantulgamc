<form method="GET" action="{{route('search')}}" class="relative flex items-center">

    <input name="q" type="text" @if(isset($search)) value="{{$search}}" @endif
        class="focus:outline-none flex-1 border placeholder-grey-darkest rounded-full bg-grey-lightest-50  py-4 px-6 pr-10 md:-mx-6 block appearance-none leading-normal text-base" placeholder="{{__('Хайх үгээ бичнэ үү')}}">
    <button class="absolute pin-r mr-3 md:-mr-3 flex items-center">
        <i class="material-icons text-3xl">search</i>
    </button>
</form>
