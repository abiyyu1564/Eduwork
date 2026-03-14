<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduShop') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #6C5CE7;
                --primary-dark: #5A4BD1;
                --primary-light: #A29BFE;
                --accent: #FD79A8;
            }
            body {
                font-family: 'Inter', sans-serif !important;
            }
            .edushop-guest-bg {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 1.5rem;
                background: linear-gradient(160deg, #F8F9FD 0%, #ede8ff 50%, #fce4ec 100%);
            }
            .edushop-card {
                width: 100%;
                max-width: 28rem;
                margin-top: 1.5rem;
                padding: 2rem 1.5rem;
                background: #fff;
                box-shadow: 0 8px 30px rgba(108, 92, 231, 0.10);
                border-radius: 16px;
                overflow: hidden;
            }
            /* Override Breeze's indigo focus rings to match EduShop */
            [type='checkbox']:checked { background-color: var(--primary) !important; }
            [type='checkbox']:focus { --tw-ring-color: var(--primary-light) !important; }
            .text-indigo-600 { color: var(--primary) !important; }
            .focus\:ring-indigo-500:focus { --tw-ring-color: var(--primary) !important; }
        </style>
    </head>
    <body>
        <div class="edushop-guest-bg">
            <div>
                <a href="/" style="text-decoration: none;">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="edushop-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
