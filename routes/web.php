<?php

use Illuminate\Support\Facades\Auth;
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

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index');
        Route::match(['get', 'post'],'/create', [AdminIndexController::class, 'create'])->name('create');
        Route::match(['get', 'post'],'/export', [AdminIndexController::class, 'export'])->name('export');
        Route::get('download',[AdminIndexController::class, 'downloadImg'])->name('download');
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
