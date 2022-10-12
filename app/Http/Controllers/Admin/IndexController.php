<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Queries\CategoryQueryBuilder;
use App\Queries\NewsQueryBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IndexController extends Controller
{

    public function index(NewsQueryBuilder $builder): Factory|View|Application
    {
        return view('admin.index', [
            'newsList' => $builder->getAllNews(),
        ]);
    }

    public function categoryIndex(CategoryQueryBuilder $builder): Factory|View|Application
    {
        return view('admin.category.index', [
            'categoryList' => $builder->getCategories(),
        ]);
    }

    public function downloadImg(): StreamedResponse
    {
        return Storage::download('/public/1.jpg');
    }
}
