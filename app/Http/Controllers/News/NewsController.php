<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News\News;
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;

class NewsController extends Controller
{
    public function index(News $newsArray): Factory|View|Application
    {
        $news = $newsArray->getNews();
        return view('news.index')->with('news', $news);
    }

    public function show(News $newsArray, $id): Factory|View|Application
    {
        $news = $newsArray->getNewsById($id);
        return view('news.single')->with('news', $news);
    }

}
