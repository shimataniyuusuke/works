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

        if (strstr($_SERVER["REQUEST_URI"], "/laravel/public/subscription")) {
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
