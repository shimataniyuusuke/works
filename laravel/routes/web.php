<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


/*
 *
 * Welcomeページ
 *
 *
 * */

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    Route::get('/', 'App\Http\Controllers\Auth\AuthDashboardController@index');
//});

Route::prefix('/dashboard')->group(function () {
    Route::get('/', 'App\Http\Controllers\Auth\AuthDashboardController@index')->middleware(['auth'])->name('dashboard');
});


/*
 * ボタン等サンプルモックページ
 * */
Route::get('/mock', function () {
    return view('mock');
})->middleware(['auth'])->name('mock');



/*
 *
 * ニュース取得
 *
 * */

//Route::get('/news', 'App\Http\Controllers\ApiController@index');

Route::prefix('/news')->group(function () {
    Route::get('/', 'App\Http\Controllers\ApiController@index')->middleware(['auth'])->name('news');
});

/*
 *
 * 決済
 *
 * */


//サブスク
Route::prefix('/subscription')->group(function () {
    Route::get('/', function () {
        return view('subscription', [
            'intent' => auth()->user()->createSetupIntent()
        ]);
    })->middleware(['auth'])->name('subscription');
});


Route::post('/user/subscribe', function (Request $request) {
    $request->user()->newSubscription('default', 'price_1KmA8MK7lmvOdVn5cB8F8sZb')
        ->trialDays(14)//2週間のトライアル設定
        ->create($request->paymentMethodId);

    return redirect('/dashboard');
})->middleware(['auth'])->name('subscribe.post');


//単発購入
Route::get('/purchase', function () {
    return view('purchase');
})->middleware(['auth'])->name('purchase');

Route::post('/purchase', function (Request $request) {
    $request->user()->charge(
        100,
        $request->paymentMethodId
    );

    return redirect('/dashboard');
})->middleware(['auth'])->name('purchase.post');

/*
 *
 * スクレイピング
 *
 * */

Route::get('scraping_page', function () {
    return view('scraping_page');
});

/*
 *
 * ヒートマップ
 * */


Route::prefix('/heatmap')->group(function () {
    Route::get('/', 'App\Http\Controllers\HeatmapController@index');
});



/*
 *
 * ソーシャルログイン
 *https://qiita.com/yamato127/items/e99877b4471c446d6cb5
 * */
Auth::routes();
Route::prefix('login')->name('login.')->group(function () {
    //FaceBook login
    Route::get('/facebook/redirect', [LoginController::class, 'redirectToFacebookProvider'])->name('facebook.redirect');
    Route::get('/facebook/callback', [LoginController::class, 'handleProviderFacebookCallback'])->name('facebook.callback');

    //LINE login
    Route::get('/line/redirect', [LoginController::class, 'redirectToLineProvider'])->name('line.redirect');
    Route::get('/line/callback', [LoginController::class, 'handleProviderLineCallback'])->name('line.callback');
});


//APPLE login
//https://devpeel.com/implement-apple-sign-in-with-laravel/
Route::post('apple/login', 'API\\Auth\\AppleLoginController@login');


/*
 *
 * 会員管理
 *
 * */
require __DIR__.'/auth.php';

