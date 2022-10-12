<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\{Category, News};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
    public function index(): Factory|View|Application|Collection
    {
        return view('news.categories')
            ->with('categories', Category::all());
    }


    public function show(string $slug): Factory|View|Application|Collection
    {
        $findValue = Category::where('slug', $slug);
        return view('news.category')
            ->with('category', News::where('category_id', $findValue->value('id'))->get())
            ->with('nameCategory', $findValue->value('title'));
    }

}
