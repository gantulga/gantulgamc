<?php

use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker) {

    $user_id = DB::table('users')->first()->id;
    $parent = DB::table('pages')->inRandomOrder()->first();
    $title = $faker->sentence(2);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        //'content' => $faker->text,
        'status' => 'publish',
        'user_id' => $user_id,
        'parent_id' => $parent ? $parent->id : null,
    ];
});
