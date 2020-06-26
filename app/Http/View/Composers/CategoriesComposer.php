<?php

namespace App\Http\View\Composers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Category;

class CategoriesComposer
{
    /**
     * The user repository implementation.
     *
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * Create a new profile composer.
     *
     * @param  CategoryRepository  $categories
     * @return void
     */
    public function __construct(/*CategoryRepository $categories*/)
    {
        $this->categories = Category::orderBy('path')->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categories);
    }
}
