<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Laravel\Cashier\Cashier;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


/*
 *
 * ニュース取得
 *
 * */

Route::get('/news', 'App\Http\Controllers\ApiController@index');


/*
 *
 * 決済
 *
 * */

//サブスク

Route::get('/subscription', function () {
    return view('subscription', [
        'intent' => auth()->user()->createSetupIntent()
    ]);
})->middleware(['auth'])->name('subscription');


Route::post('/user/subscribe', function (Request $request) {
    $request->user()->newSubscription('default', 'price_1KbJayK7lmvOdVn5dt2h3MNf')
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
        100, $request->paymentMethodId
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

// LINEの認証画面に遷移
Route::get('auth/line', 'App\Http\Controllers\Auth\LineOAuthController@redirectToProvider')->name('line.login');
// 認証後にリダイレクトされるURL(コールバックURL)
Route::get('auth/line/callback', 'App\Http\Controllers\Auth\LineOAuthController@handleProviderCallback');


/*
 *
 * 会員管理
 *
 * */
require __DIR__.'/auth.php';

