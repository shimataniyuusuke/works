<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('login/{provider}')->where(['provider' => '(line|twitter|facebook|google|yahoo)'])->group(function(){
    Route::get('/', [App\Http\Controllers\LoginController::class, 'redirectToProvider'])->name('sns_login.redirect');
    Route::get('/callback', [App\Http\Controllers\LoginController::class, 'handleProviderCallback'])->name('sns_login.callback');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
