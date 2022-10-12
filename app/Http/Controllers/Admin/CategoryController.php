<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Queries\CategoryQueryBuilder;
use App\Queries\NewsQueryBuilder;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Exception;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use App\Models\News\{Category, News};
use Symfony\Component\HttpFoundation\{BinaryFileResponse, StreamedResponse};
use Illuminate\Support\Str;

class CategoryController extends Controller
{


    public function create(Request $request, CategoryQueryBuilder $builder): View|Factory|Application|RedirectResponse
    {
        if ($request->isMethod('post')) {

            $newCategory = $request->except('_token');
            $category = $builder->create(
                $builder->checkSlug($newCategory)
            );

            if ($category) {
                return redirect()->route('admin.category.index')
                    ->with('success', 'Категория успешно добавлена');
            }

            return back()->with('error', 'Не удалось добавить категорию');
        }

        return view('admin.category.create');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(
        Request $request,
        Category $category,
        CategoryQueryBuilder $builder,
    ): RedirectResponse {

        if ($builder->update($category, $request->except('_token'))) {
            return redirect()->route('admin.category.index')
                ->with('success', 'Запись успешно обновлена');
        }

        return back()->with('error', 'Не удалось обновлена запись');
    }

    public function destroy(Category $category)
    {
        dump($category);
    }

}
