<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 外部サービスの認証ページへリダイレクトする。
     */
    public function redirectToLineProvider()
    {
        return Socialite::driver('line')->redirect();
    }

    /**
     * 外部サービスからユーザー情報を取得し、ログインする。
     */
    public function handleProviderLineCallback(Request $request)
    {
        $line_user = Socialite::driver('line')->user();
        $user = User::firstOrCreate(
            ['line_user_id' => $line_user->id],
            ['name' => $line_user->name]
        );

        $this->guard()->login($user, true);
        return $this->sendLoginResponse($request);
    }


    /**
     * 外部サービスの認証ページへリダイレクトする。
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * 外部サービスからユーザー情報を取得し、ログインする。
     */
    public function handleProviderFacebookCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();

        // すでにFacebook登録済みじゃなかったらユーザーを登録する
        $userModel = User::where('facebook_id', $user->id)->first();
        if (!$userModel) {
            $userModel = new User([
                                      'name'        => $user->name,
                                      'email'       => $user->email,
                                      'facebook_id' => $user->id
                                  ]);

            $userModel->save();
        }
        // ログインする
        Auth::login($userModel);

        $this->guard()->login($userModel, true);
        return $this->sendLoginResponse($request);
    }


}
