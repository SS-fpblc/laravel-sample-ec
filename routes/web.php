<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ユーザー認証関連
// Auth::routes();

// プロフィール詳細
// Route::resource('users', UserController::class)->only(['show']);

// トップページ
// Route::get('/', Market::class)->name('top');
// // いずれ分けるかもしれないが現時点ではトップページが一覧を兼ねる。
// Route::get('/items', Market::class);

// // 商品 詳細 / 追加 / 編集
// Route::resource('items', ItemController::class);

// Route::get('/admin', Admin::class)->name('admin');

// ↑ 元々   新規↓

// 認証
Auth::routes();

// ユーザー
Route::controller(UserController::class)->group(function(){
    Route::get('mypage/', 'index')->name('user.index');
    Route::get('mypage/history', 'history')->name('user.history');
    Route::get('mypage/watchlist', 'watchlist')->name('user.watchlist');
    Route::patch('users/{item}/toggleWatch/', 'toggleWatch')->name('user.tobbleWatch');
});

// 商品
Route::controller(ItemController::class)->group(function(){
    // Guest
    Route::get('/', 'index')->name('top');
    Route::get('item/{item}/detail/', 'show')->name('item.show');
    Route::get('item/result/', 'result')->name('item.result');
    Route::get('item/category/{category}/', 'categorize')->name('item.category');
});

// バスケット/ショッピングカート
Route::controller(BasketController::class)->group(function(){
    Route::get('basket/', 'index')->name('basket.index');
    Route::patch('basket/add/{item}', 'add')->name('basket.add');
    Route::delete('basket/remove/{id}/', 'remove')->name('basket.remove');
    Route::post('basket/settle/', 'settle')->name('basket.settle');
    Route::get('basket/complete/{order}', 'complete')->name('basket.complete');
});

// 管理者ダッシュボード
Route::prefix('dashboard')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/', 'index')->name('dashboard');
        Route::get('/item/', 'item')->name('dashboard.item');
        Route::get('/user/', 'user')->name('dashboard.user');
    });
    Route::resource('item', ItemController::class)->only(['store', 'edit', 'update', 'destroy']);
});
