<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\support\Facades\Auth;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string|null
     */
    protected function redirectTo($request)
    {

        //ニュースは月額課金の仕組みにするのでまずログインしているかどうか
        if(strstr(url()->full(),"news")){
            if (!Auth::check()) {
                return route('login');
            }
            //ログインされていても課金状況がfalseなら課金アナウンスページへ飛ばす
            elseif(Auth::check()){
                //課金状況の取得
                $user = User::make()
                    ->get();
            }
        }

        if (strstr(url()->full(), "/laravel/public/subscription")) {
            //ログインされてなければまずログイン画面へ遷移する
            if (!Auth::check()) {
                return route('login');
            }

            return view("subscription");
        }

        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
