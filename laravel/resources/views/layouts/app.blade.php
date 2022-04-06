<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

        <style>
            #card-element {
                border-radius: 4px 4px 0 0 ;
                padding: 12px;
                border: 1px solid rgba(50, 50, 93, 0.1);
                height: 44px;
                width: 100%;
                background: white;
            }

            #card-element,#card-holder-name {
                border-radius: 4px 4px 0 0 ;
                padding: 12px;
                border: 1px solid rgba(50, 50, 93, 0.1);
                height: 44px;
                width: 100%;
                background: white;
            }

            button#card-button {
                background: #5469d4;
                color: #ffffff;
                font-family: Arial, sans-serif;
                border-radius: 0 0 4px 4px;
                border: 0;
                padding: 12px 16px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                display: block;
                box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
                width: 100%;
            }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/stripe.js') }}" defer></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
        <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    </body>
</html>
