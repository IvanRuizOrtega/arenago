<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ARENAGO') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/login-users.js',
        'resources/js/change-role.js',
        'resources/js/form-ranking.js',
        'resources/js/booking-system.js',
        'resources/js/team.js',
    ])
    @endif
</head>

<body
    class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen transition-colors duration-500">
    <!-- Ambient background -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-emerald-500/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-600/10 rounded-full blur-[120px]"></div>
    </div>

    <!-- Main Container -->
    <div
        class="min-h-screen bg-slate-950 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-slate-900 via-slate-950 to-black text-slate-200">
        <x-nav :links="\Src\Resources\Constants\Headers::LINKS" />
        @yield('content')
    </div>

    <main class="relative z-10 max-w-7xl mx-auto px-4 pb-20">

        @if(session(\Src\Resources\Constants\Messages::SESSION_MESSAGE))
        @php
        $_message_ = session(\Src\Resources\Constants\Messages::SESSION_MESSAGE);
        @endphp
        <x-modal :title="$_message_['title'] ?? null" :description="$_message_['description'] ?? null"
            :forget="$_message_['forget'] ?? false" :alertColor="$_message_['alertColor'] ?? null" />
        @endif

        @if(isAuth())
        <x-floating-role-change />
        @endif
    </main>

</body>
<script>
    // Arranca Alpine manualmente al final de todo el HTML y scripts
    document.addEventListener("DOMContentLoaded", () => {
        if (window.Alpine) {
            window.Alpine.start();
        }
    });
</script>
</html>
