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
