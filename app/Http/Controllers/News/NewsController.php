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
    public function index(News $news): Factory|View|Application
    {
        return view('news.index', [
        'news' => $news
            ->orderBy('id', 'desc')
            ->paginate(config('pagination.news')),
            ]);
    }

    public function show(int $id)
    {
        return view('news.single')->with('news', News::findOrFail($id));
    }

}
