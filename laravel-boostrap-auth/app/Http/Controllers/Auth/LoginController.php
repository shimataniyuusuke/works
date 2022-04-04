<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Socialite;
use App\User;
use App\IdentityProvider;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//    public function redirectToProvider($social)
//    {
//
//            return Socialite::driver($social)->redirect();
//    }

        public function redirectToProvider()
        {
            return Socialite::driver('facebook')->redirect();
        }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($providerUser, $provider)
    {
        $account = IdentityProvider::whereProviderName($provider)
            ->whereProviderId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                                         'email' => $providerUser->getEmail(),
                                         'name'  => $providerUser->getName(),
                                     ]);
            }

            $user->IdentityProviders()->create([
                                                   'provider_id'   => $providerUser->getId(),
                                                   'provider_name' => $provider,
                                               ]);

            return $user;
        }
    }



//    public function redirectToProvider()
//    {
//        return Socialite::driver('facebook')->redirect();
//    }
//
//    /**
//     * Obtain the user information from GitHub.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function handleProviderCallback()
//    {
//        $user = Socialite::driver('facebook')->user();
//
//        dd($user); // Facebookから取得した情報を表示
//    }

}
