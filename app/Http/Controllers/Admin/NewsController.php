<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsExport;
use App\Http\Controllers\Controller;
use App\Queries\NewsQueryBuilder;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use App\Models\News\{Category, News};
use Symfony\Component\HttpFoundation\{BinaryFileResponse, StreamedResponse};

class NewsController extends Controller
{
    public function create(Request $request, NewsQueryBuilder $builder): View|Factory|Application|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $request->flash();

            $newNews = $request->except('_token');
            $news = $builder->create($newNews);

            if ($news) {
                return redirect()->route('news.show', $news['id'])
                    ->with('success', 'Запись успешно добавлена');
            }

            return back()->with('error', 'Не удалось добавить запись');
        }

        return view('admin.news.create', [
            'categories' => Category::all(),
        ]);
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', [
            'news' => $news,
            'categories' => Category::all(),
        ]);
    }

    public function update(
        Request $request,
        News $news,
        NewsQueryBuilder $builder,
    ): RedirectResponse {

        if ($builder->update($news, $request->except('_token'))) {
            return redirect()->route('admin.index')
                ->with('success', 'Запись успешно обновлена');
        }

        return back()->with('error', 'Не удалось обновлена запись');
    }

    public function destroy(News $news)
    {
        dump($news);
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function export(Request $request): View|Factory|BinaryFileResponse|Application
    {
        if ($request->isMethod('post')) {
            $id = $request->except('_token');

            return Excel::download(new NewsExport($id['category']), 'news.xlsx');
        }

        return view('admin.news.export', [
            'categories' => Category::all(),
        ]);
    }

}
