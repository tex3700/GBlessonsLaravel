<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Queries\NewsQueryBuilder;
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    public function index(News $news)
    {
        return view('news.index', [
        'news' => $news->where('isPrivate', 0)->paginate(config('pagination.news')),
            ]);
    }

    public function show(int $id)
    {
        return view('news.single')->with('news', News::findOrFail($id));
    }

   /* public function index(News $newsArray): Factory|View|Application
    {
        return view('news.index')->with('news', $newsArray->getNews());
    }

    public function show(News $newsArray, $id): Factory|View|Application
    {
        return view('news.single')->with('news', $newsArray->getNewsById($id));
    }*/

}
