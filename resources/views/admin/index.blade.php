@php
    $config = [
        'base_url' => config('app.admin_dir'),
        'app_url' => config('app.url'),
        'app_name' => config('app.name'),
        'logo' => asset('assets/img/logo/logo-admin.png')
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Dashboard - {{ config('app.name') }}</title>
        <script>
            window.config = @json($config);
        </script>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/app/main.ts'])
        @endif
    </head>
    <body class="theme-gray-600">
       <div id="app"></div>
    </body>
</html>