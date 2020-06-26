<?php
$current = now() < $job->starts_at ? -1 : (now() < $job->expires_at ? 0 : 1);
$steps = [
    'Анкет хүлээн авч байна',
    'Сонгон шалгаруулалт явагдаж байна',
    'Шалгаруулалт дууссан',
]

?>

<div class="bg-grey-lighter rounded text-xs ">
    <ul class="list-reset md:flex mb-6 px-4 md:px-0 py-4 md:pb-3 md:-mx-12">
        @foreach ($steps as $i => $step)
            <li class="md:w-1/{{count($steps)}} flex items-center {{($i+1)==count($steps)?'':'mb-3 md:my-0'}} md:flex-col">
                <div class="relative md:w-full flex items-center md:flex-col">
                    <?php
                    $class = 'bg-grey-lighter text-primary';
                    if($current == $i) $class = 'bg-primary-dark text-white font-bold';
                    if($current > $i) $class = 'bg-primary text-white';
                    ?>
                    @if ($i>0)
                    <div class="absolute border-primary border-l border-r md:border-t-2 md:h-0 h-full md:w-full" style="right:50%; bottom:50%;"></div>
                    @endif
                    <div class="relative z-10 w-8 h-8 border-2 border-primary flex items-center justify-center rounded-full {{$class}}">
                        <span>{{ $current<=$i ? $i+1 : '✔'}}</span>
                    </div>
                </div>
                <div class="px-3">{{$step}}</div>
            </li>
        @endforeach
    </ul>
</div>

