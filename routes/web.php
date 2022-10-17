<?php

use Illuminate\Support\Facades\{Auth, Route, Response,};
use App\Http\Controllers\{HomeController, IndexController};
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProfileController;
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

Route::get('/', [IndexController::class, '__invoke'])->name('index');

Route::view('/about', 'about')->name('about');

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::match(['get', 'post'],'/account/update', [HomeController::class, 'update'])->name('account.update');

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->group( function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index');
        Route::get('download',[AdminIndexController::class, 'downloadImg'])->name('download');
        Route::name('news.')
            ->group(function () {
                Route::match(['get', 'post'],'/news', [AdminNewsController::class, 'index'])->name('index');
                Route::match(['get', 'post'],'/news/create', [AdminNewsController::class, 'create'])->name('create');
                Route::match(['get', 'post'],'/news/edit/{news}',[AdminNewsController::class, 'edit'])->name('edit');
                Route::match(['get', 'post'],'/news/export', [AdminNewsController::class, 'export'])->name('export');
                Route::post('/news/update/{news}',[AdminNewsController::class, 'update'])->name('update');
                Route::delete('/news/destroy/{news}',[AdminNewsController::class, 'destroy'])->name('destroy');
            });
        Route::name('category.')
            ->group(function () {
                Route::get('/category', [AdminCategoryController::class, 'index'])->name('index');
                Route::match(['get', 'post'],'/category/create', [AdminCategoryController::class, 'create'])->name('create');
                Route::get('/category/edit/{category}',[AdminCategoryController::class, 'edit'])->name('edit');
                Route::post('/category/update/{category}',[AdminCategoryController::class, 'update'])->name('update');
                Route::delete('/category/destroy/{category}',[AdminCategoryController::class, 'destroy'])->name('destroy');
            });
        Route::name('profile.')
             ->group(function () {
                 Route::get('/profile', [ProfileController::class, 'index'])->name('index');
                 Route::match(['get', 'post'],'/profile/update/{user}',[ProfileController::class, 'update'])->name('update');
                 Route::delete('/profile/destroy/{user}',[ProfileController::class, 'destroy'])->name('destroy');
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


