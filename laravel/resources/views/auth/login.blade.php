<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="assets/images/logo" alt="logo出てないよ">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('ログイン情報を保存する') }}</span>
                </label>
            </div>

                <div class="block mt-4">
                    <a href="{{ route('login.facebook.redirect') }}">
                            <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                                 data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path fill="currentColor"
                                      d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z"></path>
                            </svg>
                            Sign in with Facebook
                        </button>
                    </a>
                </div>

                <div class="block mt-4">
                    <a href="{{ route('login.line.redirect') }}">
                        <img src="{{asset('images/images/DeskTop/1x/44dp/btn_login_base.png')}}" alt="">
                        本Webサービスでは、ログイン時の認証画面にて許可を頂いた場合のみ、あなたのLINEアカウントに登録されているメールアドレスを取得します。<br />
                        取得したメールアドレスは、以下の目的以外では使用いたしません。また、法令に定められた場合を除き、第三者への提供はいたしません。
                    </a>
                </div>


            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('パスワードを忘れた方はこちら') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('ログイン') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
