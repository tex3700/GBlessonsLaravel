<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Http\Requests\News\ExportReguest;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use App\Models\News\{Category, News};
use Symfony\Component\HttpFoundation\{BinaryFileResponse, StreamedResponse};

class NewsController extends Controller
{

    public function index(News $news): Factory|View|Application
    {
        return view('admin.news.index', [
            'newsList' => $news->with('category')
                ->orderBy('id', 'desc')
                ->paginate(config('pagination.admin.news')),
        ]);
    }

    public function create(News $news): View|Factory|Application|RedirectResponse
    {
        return view('admin.news.create', [
            'categories' => Category::all(),
            'title_page' => 'Добавить статью',
            'route' => 'admin.news.store',
            'news' => $news,
        ]);
    }

    public function store(CreateRequest $request, News $news): RedirectResponse
    {
        if (!empty($request->old())) {
            $news->fill($request->old());
        }

        if ($news->fill($request->validated())->save()) {
            return redirect()->route('news.show', $news['id'])
                ->with('success', __('messages.admin.news.create.success'));
        }

        return back()->with('error', __('messages.admin.news.create.fail'));
    }

    public function edit(News $news): Factory|View|Application
    {
        return view('admin.news.create', [
            'news' => $news,
            'categories' => Category::all(),
            'title_page' => 'Редактировать статью',
            'route' => 'admin.news.update',
        ]);
    }

    public function update(
        EditRequest $request,
        News $news,
        UploadService $uploadService,
    ): RedirectResponse {

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $uploadService->uploadImage($request->file('image'));
        }

        if ($news->fill($validated)->save()) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.update.success'));
        }

        return back()->with('error', __('messages.admin.news.update.fail'));
    }

    public function destroy(News $news): JsonResponse
    {
        try {
            $deleted =  $news->delete();
            if ($deleted === false) {
                return response()->json( "error", 400);
            }
            return response()->json("ok");
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json( "error", 400);
        }
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function export(Request $request): View|Factory|BinaryFileResponse|Application
    {
        if ($request->isMethod('post')) {
            $id = $request->except('token');

            return Excel::download(new NewsExport($id['category']), 'news.xlsx');
        }

        return view('admin.news.export', [
            'categories' => Category::all(),
        ]);
    }

}
