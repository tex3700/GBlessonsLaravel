<?php

use Illuminate\Support\Facades\{Auth, Route, Response,};
use App\Http\Controllers\{HomeController, IndexController, ProfileController};
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\{UserController, ParserController, ExportController};
use App\Http\Controllers\News\{NewsController, CategoryController};
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SocialController;

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

Route::get('/', IndexController::class)->name('index');

Route::view('/about', 'about')->name('about');

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::match(['get', 'post'],'/account/update', [ProfileController::class, 'update'])->name('account.update');

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->group( function () {

        Route::get('/', [AdminIndexController::class, 'index'])->name('index');
        Route::get('download',[AdminIndexController::class, 'downloadImg'])->name('download');
        Route::get('parser', ParserController::class )->name('parser');
        Route::match(['get', 'post'],'/news/export', ExportController::class)->name('news.export');
        Route::resource('news', AdminNewsController::class);
        Route::resource('category', AdminCategoryController::class);

        Route::name('profile.')
             ->group(function () {
                 Route::get('/profile', [UserController::class, 'index'])->name('index');
                 Route::match(['get', 'post'],'/profile/update/{user}',[UserController::class, 'update'])->name('update');
                 Route::delete('/profile/destroy/{user}',[UserController::class, 'destroy'])->name('destroy');
             });
//        Route::resource('profile', UserController::class);
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

Route::middleware('guest')
    ->group(function () {
    Route::get('/auth/redirect/{driver}', [SocialController::class, 'redirect'])
        ->where('driver', '\w+')
        ->name('social.auth.redirect');

    Route::get('/auth/callback/{driver}', [SocialController::class, 'callback'])
        ->where('driver', '\w+');
});

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


