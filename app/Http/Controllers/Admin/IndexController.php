<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News\{Category, News};
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IndexController extends Controller
{

    public function index(News $news): Factory|View|Application
    {
        return view('admin.index', [
            'newsList' => $news->with('category')
                ->orderBy('id', 'desc')
                ->paginate(config('pagination.admin.news')),
        ]);
    }

    public function categoryIndex(Category $category): Factory|View|Application
    {
        return view('admin.category.index', [
            'categoryList' => $category->paginate(config('pagination.admin.categories')),
        ]);
    }

    public function downloadImg(): StreamedResponse
    {
        return Storage::download('/public/1.jpg');
    }
}
