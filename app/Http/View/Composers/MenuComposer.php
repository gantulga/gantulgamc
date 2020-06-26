<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Menu;

class MenuComposer
{
    /**
     * The user repository implementation.
     *
     * @var MenuRepository
     */
    protected $menus;

    /**
     * Create a new menu composer.
     *
     * @param  MenuRepository  $menus
     * @return void
     */
    public function __construct(/*MenuRepository $menus*/)
    {
        // Dependencies automatically resolved by service container...
        //$this->menus = $menus;

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $name = $view->getData()['name'];

        $menu = $this->getMenu($name);

        $view->with('menu', $menu);
    }

    private function getMenu($name)
    {
        return Menu::with('items.items')->whereSlug($name)->first();

        /*
        $menus = json_decode('{
            "main": {
                "name": "Main menu",
                "items": [
                    {
                        "name": "Бидний тухай",
                        "url": "about",
                        "options": {}
                    },
                    {
                        "name": "Үйл ажиллагаа",
                        "url": "operations",
                        "options": {}
                    },
                    {
                        "name": "Бүтээгдэхүүн",
                        "url": "products",
                        "options": {}
                    },
                    {
                        "name": "Хүний нөөц",
                        "url": "human-resource",
                        "options": {}
                    },
                    {
                        "name": "Худалдан авалт",
                        "url": "procurement",
                        "options": {}
                    },
                    {
                        "name": "Шилэн данс",
                        "url": "shilen-dans",
                        "options": {}
                    },
                    {
                        "name": "Erdenet Today",
                        "url": "news/cat/erdenet-today",
                        "options": {
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
                        "options": {},
                        "items": [
                            {
                                "name": "Товч танилцуулга",
                                "url": "about",
                                "options": {}
                            },
                            {
                                "name": "Эрхэм зорилго",
                                "url": "about/mission",
                                "options": {}
                            },
                            {
                                "name": "Төлөөлөн удирдах зөвлөл",
                                "url": "about/board",
                                "options": {}
                            },
                            {
                                "name": "Удирдлагууд",
                                "url": "about/management",
                                "options": {}
                            },
                            {
                                "name": "Хөгжлийн зүгт",
                                "url": "about/developement",
                                "options": {}
                            },
                            {
                                "name": "Шагнал",
                                "url": "about/prize",
                                "options": {}
                            },
                            {
                                "name": "Түүх",
                                "url": "about/history",
                                "options": {}
                            },
                            {
                                "name": "Хамтын ажиллагаа",
                                "url": "about/cooperation",
                                "options": {}
                            }
                        ]
                    },
                    {
                        "name": "Худалдан авалт",
                        "url": "procurement",
                        "options": {},
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
                        "options": {},
                        "items": [
                            {
                                "name": "Зэсийн баяжмал",
                                "url": "products/"
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
                        "options": {},
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
                        "options": {},
                        "items": [
                            {
                                "name": "Хүний нөөцийн бодлого",
                                "url": "human-resource/"
                            },
                            {
                                "name": "Нээлттэй ажлын байр",
                                "url": "human-resource/vacancy"
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
                        "options": {},
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
                        "options": {},
                        "items": [
                            {
                                "name": "2017",
                                "url": "shilen-dans/"
                            },
                            {
                                "name": "2018",
                                "url": "shilen-dans/"
                            }
                        ]
                    }
                ]
            }
        }', true);

        $menus['sidebar'] = $menus['footer'];

        return $menus[$name] ?? ['items'=>[]];
        */
    }
}
