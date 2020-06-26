<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = once(function () {
            return DB::table('users')->first()->id;
        });

        App\Page::create([
            'title' => 'Нүүр хуудас',
            'slug' => 'home',
            'status' => App\PublishStatus::PUBLISH,
            'user_id' => $user_id,
            'props' => json_decode('{"blocks": [{"id": "KqmKVR3m8SZW", "type": "Carousel", "attributes": {"id": "main-slider", "slides": [{"id": "LALgV4DPAsg0", "link": "/home", "image": "media/0YqURoI6fIbHpuLcQ79wzfd7CHcRrffzBAsWEO8G.png", "title": "Геологи, уул уурхай", "caption": "бүтээн байгуулалтын түүхийн эзэд нэгэн дор цуглаж, Эрдэнэт үйлдвэрийн 40 жилийн түүхийг Нийслэл хотод сөхлөө\n                  "}, {"id": "3OewxajW7s6", "link": "#", "image": "media/ZQmcxi3H2Lf8F7WI7lj6ccZ8ZMbuleg0PKm7H7QJ.png", "title": "Геологи, уул уурхай 2", "caption": "бүтээн байгуулалтын түүхийн эзэд нэгэн дор цуглаж, Эрдэнэт үйлдвэрийн 40 жилийн түүхийг Нийслэл хотод сөхлөө\n"}, {"id": "RVBJaGMWvu9", "link": "#", "image": "media/A5qQbJr555yLOBOk19JA1hm9F1ET1PTF6IZNsNGq.jpeg", "title": "Геологи, уул уурхай 3", "caption": "бүтээн байгуулалтын түүхийн эзэд нэгэн дор цуглаж, Эрдэнэт үйлдвэрийн 40 жилийн түүхийг Нийслэл хотод сөхлөө\n"}, {"id": "GXZPOME2XHoj", "link": "#", "image": "media/utFxce3kUCQMjEE8WJnmO8V5W4ozLMz2R3VbjAeu.jpeg", "title": "Slide 4", "caption": "<br>\n<br>\n<br>"}]}}, {"id": "mP7NXmxVLhKL", "type": "Html", "attributes": {"content": " <div class=\"container mx-auto px-4 md:-mt-8 relative z-50 reveal\">\n    <div class=\"md:flex flex-wrap mb-4 shadow-lg\">\n        <div class=\"bg-grey-lightest md:w-5/6 flex flex-wrap items-center p-4\" >\n            <div class=\"flex-auto flex justify-center text-center md:text-left p-2 md:p-4\">\n                <div>\n                    <p>Байгуулагдсан он</p>\n                    <h2 class=\"text-primary text-3xl\">1978</h2>\n                </div>\n            </div>\n            <div class=\"flex-auto flex justify-center text-center md:text-left p-2 md:p-4\">\n                <div>\n                    <p>Нийт олборлосон зэс</p>\n                    <h2  class=\"text-primary text-3xl\">4.200.000 тн</h1>\n                </div>\n            </div>\n            <div class=\"flex-auto flex justify-center text-center md:text-left p-2 md:p-4\">\n                <div>\n                    <p>Улсад болон орон нутагт төлсөн татвар</p>\n                    <h2 class=\"text-primary text-3xl\">5.100.000.000.000 ₮</h2>\n                </div>\n            </div>\n            <div class=\"flex-auto flex justify-center text-center md:text-left p-2 md:p-4\">\n                <div>\n                    <p>Нийт ажилчид</p>\n                    <h2 class=\"text-primary text-3xl\">6.561 хүн</h2>\n                </div>\n            </div>\n        </div>\n        <a href=\"#\" class=\"md:w-1/6 bg-primary flex items-center text-right justify-center no-underline text-xs text-white p-4\">\n            <span class=\"leading-tight\">Бусад <br> мэдээлэл </span>\n            <i class=\"material-icons ml-1\">chevron_right</i>\n        </a>\n\n    </div>\n</div>\n"}}, {"id": "9ZMw3MxaPfb", "type": "Custom", "attributes": {"view": "includes.medee", "class": ""}}, {"id": "mP7NKQZNlhd", "type": "Custom", "attributes": {"view": "includes.hudaldan-avalt", "class": ""}}, {"id": "PPdJbMo2OhQ", "type": "Section", "attributes": {"id": "niigmiin-hariutslaga", "class": "hidden md:block p-4 container mx-auto mt-4 reveal", "title": "Нийгмийн хариуцлага", "blocks": [{"id": "PPdJbMloWh5", "type": "Tabs", "attributes": {"tabs": [{"id": "ORYZqBoAYc37", "name": "Бүтээн байгуулалт", "blocks": [{"id": "xB7bdjKLlIb", "type": "Carousel", "attributes": {"slides": [{"id": "MMo24PRx0So", "link": "/social-responsibility", "image": "media/5CqTs9qWw4Gyu9IjuXiYEjP2KdPWpHnEGTUXj67X.png", "title": "Бүтээн байгуулалт 1", "caption": "бүтээн байгуулалтын түүхийн эзэд нэгэн дор цуглаж, Эрдэнэт үйлдвэрийн 40 жилийн түүхийг Нийслэл хотод сөхлөө"}, {"id": "JXJ68YaQAhw", "link": "/social-responsibility", "image": "media/BN5Dvf3oBq7DJcASjGwj2Tm6NgLpFsdMniwAsUVz.jpeg", "title": "Бүтээн байгуулалт 2", "caption": ""}]}}]}, {"id": "QvnmJ46JNsO8", "name": "Эрүүл мэнд", "blocks": [{"id": "xB7bj2nPLc0G", "type": "Carousel", "attributes": {"slides": [{"id": "5QvwWDBJxhZl", "link": "/social-responsibility", "image": "media/0YqURoI6fIbHpuLcQ79wzfd7CHcRrffzBAsWEO8G.png", "title": "Slide 1", "caption": ""}, {"id": "pB7bYQw66IP8", "link": "/social-responsibility", "image": "media/0YqURoI6fIbHpuLcQ79wzfd7CHcRrffzBAsWEO8G.png", "title": "Slide 2", "caption": ""}]}}]}, {"id": "7WVwK2XB3Fo", "name": "Спорт", "blocks": [{"id": "gR7y5vJqauBe", "type": "Text", "attributes": {"content": "<div>This is just text content</div>"}}]}, {"id": "AyOlogwZECG", "name": "Соёл амралт", "blocks": []}, {"id": "9ZMw2dE7vhq7", "name": "Боловсрол", "blocks": []}]}}]}}, {"id": "LALVmpNDdU0", "type": "Custom", "attributes": {"view": "includes.virtual-tour"}}, {"id": "pB75LLJmZiP4", "type": "Columns", "attributes": {"columns": [{"id": "5QvxpMNxXUZp", "width": "1/2", "blocks": [{"id": "on7qL5mjpu6e", "type": "Section", "attributes": {"class": "md:mr-3 mt-4", "title": "Ажилд урьж байна", "blocks": [{"id": "3Oex5bp06S5g", "type": "Custom", "attributes": {"view": "includes.ajliin-bair"}}]}}]}, {"id": "LALVmOwjlFV", "width": "1/2", "blocks": [{"id": "LALVmOJExH3p", "type": "Section", "attributes": {"class": "md:ml-3 mt-4", "title": "КОМПАНИЙ ДҮРЭМ ЖУРАМ", "blocks": [{"id": "3Oex5bp06S5g", "type": "Custom", "attributes": {"view": "includes.durem-juram"}}]}}]}]}}, {"id": "KqmVNRJ9psZJ", "type": "Section", "attributes": {"class": "container mx-auto px-4 py-0 mt-4", "title": "Зургийн цомог", "blocks": []}}, {"id": "8eA380mL0T98", "type": "Section", "attributes": {"class": "bg-black-70 py-12 block-gallery", "blocks": [{"id": "eM7RPBemaT7", "type": "Columns", "attributes": {"columns": [{"id": "xB704JvY4iN", "width": "2/5", "blocks": [{"id": "6gE5MLZmeHV", "type": "Image", "attributes": {"link": "/gallery/naadam", "size": "512x384", "image": "media/5CqTs9qWw4Gyu9IjuXiYEjP2KdPWpHnEGTUXj67X.png", "caption": "ОРХОН АЙМАГ НААДАМ"}}]}, {"id": "Bj60MP4V7FD", "width": "1/5", "blocks": [{"id": "PPdA0YvoDSR", "type": "Image", "attributes": {"link": "/gallery/ui-ajillagaa", "size": "256x192", "image": "media/A5qQbJr555yLOBOk19JA1hm9F1ET1PTF6IZNsNGq.jpeg", "caption": "ҮЙЛ АЖИЛЛАГААНЫ ЗУРГУУД"}}, {"id": "2yj5AQpR3ilq", "type": "Image", "attributes": {"link": "/gallery/uildver", "size": "256x192", "image": "media/BN5Dvf3oBq7DJcASjGwj2Tm6NgLpFsdMniwAsUVz.jpeg", "caption": "ҮЙЛДВЭРИЙН ЗУРГУУД"}}]}, {"id": "on72K5QqDH6", "width": "2/5", "blocks": [{"id": "gR7Wxp37aTAB", "type": "Image", "attributes": {"link": "/gallery/tuuhen", "size": "512x384", "image": "media/ZQmcxi3H2Lf8F7WI7lj6ccZ8ZMbuleg0PKm7H7QJ.png", "caption": "ТҮҮХЭН ЗУРГУУД"}}]}]}}]}}], "template": "page/blank"}'),
        ]);

        $menu = App\Menu::with('items.items')->whereSlug('sidebar')->first();

        $this->menuItemsToPages($menu->items);

        /*
        App\Page::create([
            'title' => 'Нүүр хуудас',
            'slug' => 'home',
            //'content' => 'This is about us page.',
            'status' => 'publish',
            'user_id' => $user_id,
        ]);
        App\Page::create([
            'title' => 'Бидний тухай',
            'slug' => 'about',
            //'content' => 'This is about us page.',
            'status' => 'publish',
            'user_id' => $user_id,
        ]);
        App\Page::create([
            'title' => 'Холбоо барих',
            'slug' => 'contact',
            //'content' => 'This is contact us page.',
            'status' => 'publish',
            'user_id' => $user_id,
        ]);
        */
    }

    private function menuItemsToPages($items, $parent=null)
    {
        $user_id = once(function () {
            return DB::table('users')->first()->id;
        });

        foreach ($items as $item) {
            if (starts_with($item->url, 'http')) {
                continue;
            }
            if($this->hasRoute($item->url)) {
                continue;
            }

            $slugArr = explode('/', $item->url);

            $slug = array_pop($slugArr);

            $page = App\Page::findBySlug($slug);

            if (!$page) {
                $page = App\Page::create([
                    'title' => $item->name,
                    'slug' => $slug,
                    'status' => App\PublishStatus::PUBLISH,
                    'user_id' => $user_id,
                    'parent_id' => $parent ? $parent->id : null,
                    'props' => [
                        'blocks' => [[
                            'id' => 'asdf',
                            'type'=> 'Text',
                            'attributes' => [
                                'content' => 'Мэдээлэл оруулаагүй байна.'
                            ]
                        ]]
                    ]
                ]);
            }

            $this->menuItemsToPages($item->items, $page);
        }
    }

    private function hasRoute($url)
    {
        foreach (Route::getRoutes() as $route) {
            if($route->uri() == $url){
                return true;
            }
        }
        return false;
    }
}
