<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::transaction(function () {
            foreach($this->defaultMenus() as $slug => $menuDef){
                $items = $menuDef['items'];
                unset($menuDef['items']);
                $menuDef['slug'] = $slug;
                $menu = App\Menu::create($menuDef);
                $this->saveItems($items, $menu->id);
            }
        });
    }

    public function saveItems($items, $menu_id, $parent_id=null)
    {
        foreach($items as $itemDef){
            if(isset($itemDef['items'])) {
                $subItems = $itemDef['items'];
                unset($itemDef['items']);
            }
            //$itemDef['props'] = json_encode($itemDef['props']);
            $itemDef['menu_id'] = $menu_id;
            $itemDef['parent_id'] = $parent_id;
            $item = App\MenuItem::create($itemDef);
            if (isset($subItems)) {
                $this->saveItems($subItems, $menu_id, $item->id);
            }
        }
    }

    public function defaultMenus()
    {
        $menus = json_decode('{
            "main": {
                "name": "Main menu",
                "items": [
                    {
                        "name": "Бидний тухай",
                        "url": "about",
                        "props": {}
                    },
                    {
                        "name": "Үйл ажиллагаа",
                        "url": "operations",
                        "props": {}
                    },
                    {
                        "name": "Бүтээгдэхүүн",
                        "url": "products",
                        "props": {}
                    },
                    {
                        "name": "Хүний нөөц",
                        "url": "human-resource",
                        "props": {}
                    },
                    {
                        "name": "Худалдан авалт",
                        "url": "procurement",
                        "props": {}
                    },
                    {
                        "name": "Шилэн данс",
                        "url": "shilen-dans",
                        "props": {}
                    },
                    {
                        "name": "Erdenet Today",
                        "url": "news/cat/erdenet-today",
                        "props": {
                            "class": "bg-secondary px-3 text-white hover:text-white"
                        }
                    }
                ]
            },
            "footer": {
                "name": "Footer menu",
                "items": [
                    {
                        "name": "Бидний тухай",
                        "url": "about",
                        "props": {},
                        "items": [
                            {
                                "name": "Товч танилцуулга",
                                "url": "about",
                                "props": {}
                            },
                            {
                                "name": "Эрхэм зорилго",
                                "url": "about/mission",
                                "props": {}
                            },
                            {
                                "name": "Төлөөлөн удирдах зөвлөл",
                                "url": "about/board",
                                "props": {}
                            },
                            {
                                "name": "Удирдлагууд",
                                "url": "about/management",
                                "props": {}
                            },
                            {
                                "name": "Хөгжлийн зүгт",
                                "url": "about/developement",
                                "props": {}
                            },
                            {
                                "name": "Шагнал",
                                "url": "about/prize",
                                "props": {}
                            },
                            {
                                "name": "Түүх",
                                "url": "about/history",
                                "props": {}
                            },
                            {
                                "name": "Хамтын ажиллагаа",
                                "url": "about/cooperation",
                                "props": {}
                            }
                        ]
                    },
                    {
                        "name": "Худалдан авалт",
                        "url": "procurement",
                        "props": {},
                        "items": [
                            {
                                "name": "Тендерийн урилга",
                                "url": "procurement"
                            },
                            {
                                "name": "Худалдан авалтын бодлого",
                                "url": "procurement/policy"
                            },
                            {
                                "name": "Тендерийн үр дүн",
                                "url": "procurement/result"
                            },
                            {
                                "name": "Бүрдүүлэх материал",
                                "url": "procurement/documents"
                            },
                            {
                                "name": "Худалдах бараа материал",
                                "url": "procurement/products-for-sale"
                            },
                            {
                                "name": "Бүртгэл",
                                "url": "procurement/company/register"
                            }
                        ]
                    },
                    {
                        "name": "Бүтээгдэхүүн",
                        "url": "products",
                        "props": {},
                        "items": [
                            {
                                "name": "Зэсийн баяжмал",
                                "url": "products"
                            },
                            {
                                "name": "Молибдены баяжмал",
                                "url": "products/mo-concentrates"
                            },
                            {
                                "name": "Өрсөлдөх чадвар",
                                "url": "products/competitiveness"
                            },
                            {
                                "name": "Зэс молибдены үнэ",
                                "url": "https://www.lme.com/"
                            }
                        ]
                    },
                    {
                        "name": "Үйл ажиллагаа",
                        "url": "operations",
                        "props": {},
                        "items": [
                            {
                                "name": "Үйлдвэрлэлийн үзүүлэлт",
                                "url": "operations"
                            },
                            {
                                "name": "Геологи хайгуул",
                                "url": "operations/geo-pros"
                            },
                            {
                                "name": "Олборлолт",
                                "url": "operations/mining"
                            },
                            {
                                "name": "Тээвэрлэлт",
                                "url": "operations/transporting"
                            },
                            {
                                "name": "Баяжуулалт",
                                "url": "operations/processing"
                            },
                            {
                                "name": "Тоног төхөөрөмжийн үйлдвэрлэл",
                                "url": "operations/rmz"
                            },
                            {
                                "name": "Эрчим хүч",
                                "url": "operations/energy"
                            },
                            {
                                "name": "Автоматжуулалт",
                                "url": "operations/automation"
                            },
                            {
                                "name": "Чанар стандарт",
                                "url": "operations/quality"
                            },
                            {
                                "name": "Хөдөлмөрийн аюулгүй байдал, эрүүл ахуй",
                                "url": "operations/safety"
                            },
                            {
                                "name": "Хууль, журам",
                                "url": "operations/law"
                            },
                            {
                                "name": "Байгаль орчин",
                                "url": "operations/ecology"
                            },
                            {
                                "name": "Хөрөнгө оруулалт",
                                "url": "operations/investment"
                            }
                        ]
                    },
                    {
                        "name": "Хүний нөөц",
                        "url": "human-resource",
                        "props": {},
                        "items": [
                            {
                                "name": "Хүний нөөцийн бодлого",
                                "url": "human-resource/"
                            },
                            {
                                "name": "Нээлттэй ажлын байр",
                                "url": "human-resource/job-vacancy"
                            },
                            {
                                "name": "Хамтын гэрээний хэрэгжилт",
                                "url": "human-resource/cont-result"
                            },
                            {
                                "name": "Хөдөлмөрийн баатрууд",
                                "url": "human-resource/heroes-of-labour"
                            },
                            {
                                "name": "Гавъяат ажилтнууд",
                                "url": "human-resource/merited-employees"
                            },
                            {
                                "name": "Хөдөлмөрийн аваргууд",
                                "url": "human-resource/best-employees"
                            },
                            {
                                "name": "Хөдөлмөрийн алдартнууд",
                                "url": "human-resource/honored-employees"
                            }
                        ]
                    },
                    {
                        "name": "Нийгмийн хариуцлага",
                        "url": "social-responsibility",
                        "props": {},
                        "items": [
                            {
                                "name": "Бүтээн байгуулалт",
                                "url": "social-responsibility/developement"
                            },
                            {
                                "name": "Эрүүл мэнд",
                                "url": "social-responsibility/health"
                            },
                            {
                                "name": "Боловсрол",
                                "url": "social-responsibility/education"
                            },
                            {
                                "name": "Спорт",
                                "url": "social-responsibility/sports"
                            },
                            {
                                "name": "Соёл",
                                "url": "social-responsibility/culture"
                            },
                            {
                                "name": "Амралт",
                                "url": "social-responsibility/relax"
                            }
                        ]
                    },
                    {
                        "name": "Шилэн данс",
                        "url": "shilen-dans",
                        "props": {},
                        "items": [
                            {
                                "name": "2017",
                                "url": "shilen-dans/2017"
                            },
                            {
                                "name": "2018",
                                "url": "shilen-dans/2018"
                            }
                        ]
                    }
                ]
            }
        }', true);

        $menus['sidebar'] = $menus['footer'];
        $menus['sidebar']['name'] = 'Sidebar menu';

        $menus['sidebar']['items'][] = [
            "name" => "Зургийн цомог",
            "url" => "gallery",
            "props"=> [],
            "items"=> [
                [
                    "name"=> "Наадам",
                    "url"=> "gallery/naadam"
                ],
                [
                    "name"=> "Үйл ажиллагаа",
                    "url"=> "gallery/uil-ajillagaa"
                ],
                [
                    "name"=> "Үйлдвэрийн зургууд",
                    "url"=> "gallery/uildver"
                ],
                [
                    "name"=> "Түүхэн зургууд",
                    "url"=> "gallery/tuuhen"
                ]
            ]
        ];

        return $menus;
    }
}
