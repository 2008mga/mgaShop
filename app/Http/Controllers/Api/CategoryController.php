<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function all ()
    {
        return $this->json(
            Category::query()
                ->orderBy('num_of_products', true)
                ->get()
        );
    }

    public function popular ()
    {
        return $this->json(Category::query()->orderBy('num_of_products', true)->limit(7)->get());
    }

    public function get (Category $category)
    {
        return $this->json($category);
    }
}
