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
                    @if(auth()->user()->onTrial())
                        <p>{{ auth()->user()->trialEndsAt()->format('Y-m-d')}}までトライアル期間中です。</p>
                    @endif
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
