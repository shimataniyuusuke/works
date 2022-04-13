<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\View\Factory;

class CommonParams
{

    public function __construct(Factory $viewFactory, AuthManager $authManager)
    {
        $this->viewFactory = $viewFactory;
        $this->authManager = $authManager;
    }

    /**
     * サイト全体で使用する変数などここで統一しておく
     *
     * セッション情報
     * サーバー変数
     * パラメータ
     * ログインユーザー情報
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next)
    {
        //ログインユーザ情報
        $user = $this->authManager->user();

        //共通化
        $common = [
            'user'    => $user,
            'session' => $_SESSION,
            'server'  => $_SERVER,
            'params'  => $_REQUEST,
        ];


        $this->viewFactory->share('common', $common);

        return $next($request);
    }
}
