<?php

use Illuminate\Support\Facades\{Auth, Route, Response,};
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\News\{NewsController, CategoryController};
use Illuminate\Support\Facades\File;
;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index');
        Route::get('download',[AdminIndexController::class, 'downloadImg'])->name('download');
        Route::name('news.')
            ->group(function () {
                Route::match(['get', 'post'],'/news/create', [AdminNewsController::class, 'create'])->name('create');
                Route::match(['get', 'post'],'/news/edit/{news}',[AdminNewsController::class, 'edit'])->name('edit');
                Route::match(['get', 'post'],'/news/export', [AdminNewsController::class, 'export'])->name('export');
                Route::post('/news/update/{news}',[AdminNewsController::class, 'update'])->name('update');
                Route::delete('/news/destroy/{news}',[AdminNewsController::class, 'destroy'])->name('destroy');
            });
        Route::name('category.')
            ->group(function () {
                Route::get('/category', [AdminIndexController::class, 'categoryIndex'])->name('index');
                Route::match(['get', 'post'],'/category/create', [AdminCategoryController::class, 'create'])->name('create');
                Route::get('/category/edit/{category}',[AdminCategoryController::class, 'edit'])->name('edit');
                Route::post('/category/update/{category}',[AdminCategoryController::class, 'update'])->name('update');
                Route::delete('/category/destroy/{category}',[AdminCategoryController::class, 'destroy'])->name('destroy');
            });
    });


Route::name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/{id}', [NewsController::class, 'show'])->where(['id' => '[0-9]+'])->name('show');
        Route::name('category.')
            ->group(function () {
                Route::get('/category', [CategoryController::class, 'index'])->name('index');
                Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('show');
            });
    });

Route::view('/about', 'about')->name('about');

Auth::routes();

Route::get('storage/{filename}', function ($filename) {

    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
});


