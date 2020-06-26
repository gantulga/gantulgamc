<h4 class="py-4 border-t border-grey-lighter text-lg">{{__('Leave a comment')}}</h4>

<form  method="post" id="comment-form" class="comment-form mb-4" action="{{route('comment', ['post'=>$post])}}#comments">
    <input type="hidden" name="_token" value="{{ Session::token() }}" />
    <input type="hidden" name="_t" value="{{ Crypt::encrypt(time()) }}" />
    <input type="hidden" name="parent" value="" />
    <input type="hidden" name="homepage" value="" />
    @if (session('comment-success'))
        <div role="alert" class="bg-green-lightest border border-green-light text-green-dark px-4 py-3 rounded relative mb-4" >
            <strong class="font-bold">{{__('Success')}}!</strong>
            <span class="-block -sm:inline">{{ session('comment-success') }}</span>
            <span class="absolute pin-t pin-b pin-r px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="(function(e){
                    var alert = e.srcElement.closest('div[role=alert]');
                    alert.style.transition = 'opacity 300ms linear';
                    alert.style.opacity = '0';
                    setTimeout(function(){alert.remove();}, 500);
                })(event)">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </span>
        </div>
    @endif

    {!! $errors->first('comment', '<p class="help-block text-red mb-2">:message</p>') !!}
    <textarea class="border {{ $errors->has('comment') ? 'border-red' : 'border-grey' }} w-full p-3 rounded" rows="2" name="comment" id="comment" placeholder="{{__('Comment')}}">{{ Request::old('comment') }}</textarea>

    @if (Auth::guest())
        <input type="text" class="border {{ $errors->has('name') ? 'border-red' : 'border-grey' }} w-1/2 p-3 rounded" name="name" id="name" value="{{ Request::old('name') }}" placeholder="{{__('Guest')}}">
        {!! $errors->first('name', '<p class="help-block text-red mb-2">:message</p>') !!}
    @endif
    <input type="submit" class="btn btn-primary pull-right px-4 py-2 my-4 rounded" id="submit" value="Нийтлэх" />

</form>
