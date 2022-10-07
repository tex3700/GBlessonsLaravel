<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;

class NewsController extends Controller
{
    public function index(News $newsArray): Factory|View|Application
    {
        return view('news.index')->with('news', $newsArray->getNews());
    }

    public function show(News $newsArray, $id): Factory|View|Application
    {
        return view('news.single')->with('news', $newsArray->getNewsById($id));
    }

}
