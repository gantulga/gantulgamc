<?php
$attr = &$block['attributes'];
$attr = array_merge([
    'class' => 'container mx-auto px-4',
    'style' => '',
],$attr);
?>
<div {!! block_attr($block) !!}>

    <?php $form = \App\Form::find($block['attributes']['form']) ?>

    @include('form.form', ['form' => $form])

</div>
