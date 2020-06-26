<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["name"=>"Онцлох"],
            ["name"=>"Дотоод"],
            ["name"=>"Гадаад"],
            ["name"=>"Орон нутаг"],
            ["name"=>"Видео"],
            ["name"=>"Урлаг, спорт"],
            ["name"=>"Боловсрол"],
            ["name"=>"Эрдэнэт-40"],
            ["name"=>"Erdenet Today"],
        ];

        foreach($categories as $cat){
            $cat['slug'] =  kebab_case($cat['name']);
            App\Category::create($cat);
        }
    }
}
