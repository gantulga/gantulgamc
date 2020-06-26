<?php
$category = $category ?? null;
$post = $post ?? null;
$isCurrentCategory = function($cat) use($category, $post){
    if($post){
        return $post->categories->contains($cat->id);
    }
    if($category){
        return $category->id == $cat->id;
    }
    return false;
}
?>

<h3 class="text-grey-dark text-xs uppercase border-b border-primary pb-3">
Мэдээний ангилалууд
</h3>
<ul class="list-reset mt-6 mb-8 font-bold text-xs uppercase">
    @foreach ($categories as $category)
        <?php
        $is_active = $isCurrentCategory($category) ? ' text-primary' : ''
        ?>
        <li>
        <a class="border-b border-grey-lighter block px-1 py-3 hover:text-primary flex items-center justify-between {{$is_active}}"
                href="{{route('post.category', ['category'=>$category])}}">{{$category->name}}</a>
        </li>
    @endforeach
</ul>
