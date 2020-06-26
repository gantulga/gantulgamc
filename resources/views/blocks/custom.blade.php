
<?php
$attr = &$block['attributes'];
$attr = array_merge([
    'class' => '',
    'style' => '',
],$attr);
?>
<div {!! block_attr($block) !!}>
    @include($block['attributes']['view'], $block['attributes'])
</div>
