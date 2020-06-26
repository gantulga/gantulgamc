<?php
$attr = $block['attributes'] = array_merge([
    'class' => 'container mx-auto px-4 py-8',
],$block['attributes']);

if(isset($attr['title']))
{
    $title = $attr['title'];
    // Split on spaces.
    $title = preg_split("/\s+/", $title);
    // Replace the first word.
    $title[0] = '<span class="mr-2 text-black">' . $title[0] . '</span>';
    // Re-create the string.
    $title = join(" ", $title);
}

?>
<div {!! block_attr($block) !!}>
    <div class="container mx-auto">
        @if(isset($title))
            <h3 class="text-base uppercase mb-4 text-primary">{!!$title!!}</h3>
        @endif
        @include('blocks.index',['blocks'=>$attr['blocks']])
    </div>
</div>
