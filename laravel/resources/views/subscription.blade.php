<style>
    /********************************************
* Now Loading
********************************************/
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999;
        width: 100%;
        height: 100%;
        display: none;
        background: rgba(0, 0, 0, 0.6);
    }

    .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 80px;
        height: 80px;
        border: 4px #ddd solid;
        border-top: 4px #999 solid;
        border-radius: 50%;
        animation: sp-anime 0.8s infinite linear;
    }

    @keyframes sp-anime {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(359deg);
        }
    }

    .is-hide {
        display: none;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>コースの設定</p>
                    <select name="" id="">
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                    </select>

                    <h2>サブスクリプション</h2>
                    <!-- コピー対象要素とコピーボタン -->
                    <input id="copyTarget" type="text" value="" placeholder="なんか入力せい">
                    <button onclick="copyToClipboard()">Copy text</button>


                    <select name="" id="">
                        @foreach(Config::get('app.testcards') as $k => $v)
                            <option id="copyTarget" value="{{$v}}">{{$k}}</option>
                        @endforeach
                    </select>
                        <button onclick="copyToClipboard()">Copy text</button>
                    <form id="setup-form" action="{{ route('subscribe.post') }}" method="post">
                        @csrf
                        <input id="card-holder-name" type="text" placeholder="カード名義人" name="card-holder-name">
                        <div id="card-element"></div>
                        <button id="card-button" data-secret="{{ $intent->client_secret }}">
                            サブスクリプション
                        </button>
                    </form>
                    <!-- loding -->
                    <div id="overlay">
                        <div class="cv-spinner">
                            <span class="spinner"></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('pk_test_51KbIwkK7lmvOdVn5Cc721yB8TlmM4v1OYzu76IHDqBWqcgcum6AZOB83StnozG7r3OXgFYjT6GXXYAG1QaJdbmMB00eMDeXH12');

            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;


            // $(function () {
            //     $(".btn").on("click", function () {
            //         $("form").submit(); //フォーム実行
            //         $("#overlay").fadeIn(500); //二度押しを防ぐloading表示
            //         setTimeout(function () {
            //             $("#overlay").fadeOut(500);
            //         }, 3000);
            //     });
            // });

            cardButton.addEventListener('click', async (e) => {
                e.preventDefault()
                const {setupIntent, error} = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {name: cardHolderName.value}
                        }
                    }
                );

                if (error) {
                    // Display "error.message" to the user...
                    console.log(error);
                } else {
                    // The card has been verified successfully...
                    stripePaymentIdHandler(setupIntent.payment_method);
                }
            });

            function stripePaymentIdHandler(paymentMethodId) {
                // Insert the paymentMethodId into the form so it gets submitted to the server
                const form = document.getElementById('setup-form');

                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'paymentMethodId');
                hiddenInput.setAttribute('value', paymentMethodId);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }


            function copyToClipboard() {
                // コピー対象をJavaScript上で変数として定義する
                var copyTarget = document.getElementById("copyTarget");

                // コピー対象のテキストを選択する
                copyTarget.select();

                // 選択しているテキストをクリップボードにコピーする
                document.execCommand("Copy");

                // コピーをお知らせする
                alert("コピーできました！ : " + copyTarget.value);
            }

            function autoInputTestCardNum() {

            }

        </script>
    @endpush
</x-app-layout>
