<footer ref="footer">
    @if(!(isset($hideMenu) && $hideMenu))
        <div class=" bg-grey-lightest">
            <div class="container mx-auto px-4 pt-8 leading-tight">
                <div class="md:flex -mx-3 pt-1">
                    <div class="w-full md:w-1/4 px-3 mb-8">
                        <img class="hidden md:inline-block mb-12" src="{{asset('img/logo.svg')}}" alt="Erdenet MC"/>
                        <h4 class="text-grey-darker text-base uppercase mb-5">{{__('Contact Us')}}</h4>

                        <ul class="list-reset mb-8">
                            @if($address=settings('contact.address'))
                                <li class="flex items-top mb-4"><i class="material-icons mr-3 text-primary">location_on</i>
                                    {!!nl2br($address)!!}
                                </li>
                            @endif
                            @if($phones=settings('contact.phone'))
                                <li class="flex items-center text-base mb-2">
                                    <i class="material-icons mr-3 text-primary">phone</i>
                                    @foreach ($phones=explode(',', $phones) as $i => $phone)
                                        <a class="mr-2" href="tel:{{trim($phone)}}">{{trim($phone).(count($phones)>$i+1?',':'')}}</a>
                                    @endforeach
                                </li>
                            @endif
                            @if($emails=settings('contact.email'))
                                <li class="flex items-center text-base mb-2">
                                    <i class="material-icons mr-3 text-primary">mail_outline</i>
                                    @foreach ($emails=explode(',', $emails) as $i => $email)
                                        <a class="mr-2" href="mailto:{{trim($email)}}">{{trim($email).(count($emails)>$i+1?',':'')}}</a>
                                    @endforeach
                                </li>
                            @endif
                        </ul>
                        @include('components.sm-buttons',[
                            'twitter'=>settings('contact.twitter'),
                            'linkedIn'=>settings('contact.linkedin'),
                            'facebook'=>settings('contact.facebook'),
                        ])
                    </div>
                    <div class="w-full md:w-3/4 px-3 md:pl-12  pt-2 mb-4 hidden md:block">
                        @include('includes.menu-footer', ['name'=>'footer'])
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="bg-primary">
        <div class="container mx-auto px-4 py-6 text-white text-right">
            &copy; {{ config('app.name', 'Erdenet MC') }} - {{Carbon\Carbon::now()->year}}
        </div>
    </div>
</footer>
