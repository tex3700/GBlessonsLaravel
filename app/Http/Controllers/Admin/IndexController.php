<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use App\Models\News\{Category, News};
use Symfony\Component\HttpFoundation\{BinaryFileResponse, StreamedResponse};

class IndexController extends Controller
{

    public function index(): Factory|View|Application
    {
        return view('admin.index');
    }


    public function create(Request $request, Category $category, News $news): View|Factory|Application|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $request->flash();
            $newNews = $request->except('_token');
            $id = $news->saveNews($newNews);

            return redirect()->route('news.show', ['id' => $id]);
        }

        return view('admin.create', [
            'categories' => $category->getNewsCategories()
        ]);
    }


    public function export(Category $category, Request $request, News $news): View|Factory|BinaryFileResponse|Application
    {
        if ($request->isMethod('post')) {
            $id = $request->except('_token');

            return Excel::download(new NewsExport($id['category'], $news), 'news.xlsx');
        }

        return view('admin.export', [
            'categories' => $category->getNewsCategories()
        ]);
    }


    public function downloadImg(): StreamedResponse
    {
        return Storage::download('/public/1.jpg');
    }
}
