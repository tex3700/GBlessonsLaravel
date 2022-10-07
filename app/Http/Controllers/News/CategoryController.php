<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\{Category, News};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;

class CategoryController extends Controller
{
    public function index(Category $category): Factory|View|Application
    {
        return view('news.categories')
            ->with('categories', $category->getNewsCategories());
    }

    public function show(News $news, Category $categories, $slug): Factory|View|Application
    {
        return view('news.category')
            ->with('category', $news->getNewsByCategorySlug($slug))
            ->with('nameCategory', $categories->getCategoryNameBySlug($slug));
    }

}
