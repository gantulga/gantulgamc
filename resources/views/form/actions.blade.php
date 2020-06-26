<?php
$submit_text = $form['settings']['submit_text'] ?? __('Submit');
$submit_text_processing = $form['settings']['submit_text'] ?? __('Sending...');
?>

@component('form.fields.wrapper', ['field'=>['id'=>'_'], 'stacked'=>$stacked])

    {!! Form::submit($submit_text, ['class'=>'btn btn-primary pull-right px-4 py-2 my-4 rounded cursor-pointer']) !!}

@endcomponent
