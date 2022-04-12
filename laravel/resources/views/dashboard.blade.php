<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3>お知らせ</h3>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
                        <span class="font-medium">お知らせ</span> まもなくニュース読み放題のサブスクリプションが更新されます
                    </div>
                    @if(isset($args["payment_alert"]))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                        <span class="font-medium">カード情報をご確認ください</span> {{$args["payment_alert"]}}
                    </div>
                    @endif
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        <span class="font-medium">新着情報</span>　新春キャンペーン開始！詳しくは <a href="" style="text-decoration: underline">こちら</a>！
                    </div>
                    @if(isset($args['announce_trial_end']))
                    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                        <span class="font-medium">トライアル期間終了のお知らせ</span> {{$args['announce_trial_end']}}
                    </div>
                    @endif
                    <div class="p-4 mb-4 text-sm text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-300" role="alert">
                        <span class="font-medium">お知らせテスト</span> テストテストテストテストテストテストテストテストテストテストテストテストテストテスト
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3>購入履歴</h3>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(auth()->user()->onTrial())
                        <p>{{ auth()->user()->trialEndsAt()->format('Y-m-d')}}までトライアル期間中です。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
