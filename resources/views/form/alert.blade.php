<?php
$form_success = 'form-'.$form->name.'-success';
?>
@if (session($form_success))
<div role="alert" class="flex bg-green-lightest border border-green-light text-green-dark px-4 py-3 rounded relative mb-4" >
    <i class="far fa-check-circle fa-2x mr-3"></i>
    <div class="mr-6">{!! session($form_success) !!}</div>
    <span class="absolute pin-t pin-r px-4 py-3 flex items-center">
        <svg class="fill-current h-6 w-6 text-green" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="closeAlert(event)">
            <title>Close</title>
            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
        </svg>
    </span>
</div>
@endif

@section('scripts')
    @parent
    <script>
        function closeAlert(e){
            var alert = e.srcElement.closest('div[role=alert]');
            alert.style.transition = 'opacity 300ms linear';
            alert.style.opacity = '0';
            setTimeout(function(){alert.remove();}, 500);
        }
    </script>
@endsection
