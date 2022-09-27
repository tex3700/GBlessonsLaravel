<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News\{Category, News};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;

class CategoryController extends Controller
{
    public function index(Category $category): Factory|View|Application
    {
        $categories = $category->getNewsCategories();
        return \view('news.categories')->with('categories', $categories);
    }

    public function show(News $news, $id): Factory|View|Application
    {
        $category = $news->getNewsByCategoryId($id);
        return \view('news.category')->with('category', $category);
    }

}
