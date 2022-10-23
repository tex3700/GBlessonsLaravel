<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\EditRequest;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use App\Models\News\{Category, News};

class CategoryController extends Controller
{

    public function index(Category $category): Factory|View|Application
    {
        return view('admin.category.index', [
            'categoryList' => $category->paginate(config('pagination.admin.categories')),
        ]);
    }


    public function create(Category $category): View|Factory|Application|RedirectResponse
    {
//        if ($request->isMethod('post')) {
//
//            $createRequest = new CreateRequest();
//            $this->validate($request, $createRequest->rules(), [], $createRequest->attributes());
//
//            $newCategory = $request->all();
//            $newCategory = $category->checkSlug($newCategory);
//
//            if (!empty($request->old())) {
//                $category->fill($request->old());
//            }
//
//            if ($category->fill($newCategory)->save()) {
//                return redirect()->route('admin.category.index')
//                    ->with('success', __('messages.admin.category.create.success'));
//            }
//
//            return back()->with('error', __('messages.admin.category.create.fail'));
//        }

        return view('admin.category.create', [
            'title' => 'Добавить категорию',
            'route' => 'admin.category.store',
            'category' => $category,
        ]);
    }


    public function store(CreateRequest $request, Category $category): RedirectResponse
    {
        $newCategory = $request->validated();
        $newCategory = $category->checkSlug($newCategory);

        if (!empty($request->old())) {
            $category->fill($request->old());
        }

        if ($category->fill($newCategory)->save()) {
            return redirect()->route('admin.category.index')
                ->with('success', __('messages.admin.category.create.success'));
        }

        return back()->with('error', __('messages.admin.category.create.fail'));

    }


    public function edit(Category $category): Factory|View|Application
    {
        return view('admin.category.create', [
            'title' => 'Редактировать категорию',
            'route' => 'admin.category.update',
            'category' => $category,
        ]);
    }


    public function update(
        EditRequest $request,
        Category $category,
    ): RedirectResponse {

        if ($category->fill($request->validated())->save()) {

            return redirect()->route('admin.category.index')
                ->with('success', __('messages.admin.category.update.success'));
        }

        return back()->with('error', __('messages.admin.category.update.fail'));
    }


    public function destroy(Category $category): JsonResponse
    {
        try {
           $deleted =  $category->delete();
           if ($deleted === false) {
               return response()->json( "error", 400);
           }
           return response()->json("ok");
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json( "error", 400);
        }
    }

}
