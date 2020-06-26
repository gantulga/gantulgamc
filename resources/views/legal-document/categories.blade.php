<?php
$category = $category ?? null;
$document = $document ?? null;
$isCurrentCategory = function($cat) use($category, $document){
    if($category){
        return $category->id == $cat->id;
    }
    if($document){
        return $document->categories->contains($cat->id);
    }
    return false;
}
?>

<h3 class="text-grey-dark text-xs uppercase border-b border-primary pb-3">
    Ангилалууд
</h3>
<ul class="list-reset mt-6 mb-8 font-bold text-xs uppercase">
    @foreach ($categories as $cat)
        <?php
        $is_active = $isCurrentCategory($cat) ? ' text-primary' : ''
        ?>
        <li>
        <a class="border-b border-grey-lighter block px-1 py-3 hover:text-primary flex items-center justify-between {{$is_active}}"
                href="{{route('legal-document.category', ['category'=>$cat])}}">{{$cat->name}}</a>
        </li>
    @endforeach
</ul>
