<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\News\{NewsController, CategoryController};

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

Route::get('/admin', [AdminIndexController::class, 'index'])->name('admin.index');

Route::name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/{id}', [NewsController::class, 'show'])->where(['id' => '[0-9]+'])->name('single');
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/addNews', function () { return view('news.addNews'); })->name('add');
    });

Route::view('/about', 'about')->name('about');

