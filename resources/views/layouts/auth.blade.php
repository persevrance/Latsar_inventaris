<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Inventaris UPA-TIK">

    <title>{{ $title ?? 'Login Sistem Inventaris' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <link rel="icon" type="image/png" href="#">
</head>

<body class="bg-gray-100 dark:bg-gray-800 flex flex-col min-h-screen"
    x-data="authModal(@json($errors->any()))"
    x-init="init()">

    {{-- NAVBAR AUTH --}}


    <!-- =========================
         MODAL LOGIN
    ========================== -->
    <div x-show="showLogin"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

        <div class="relative w-full max-w-md mx-auto" @click.stop>

            <button
                @click="closeAll()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                ✕
            </button>

            @include('auth.partials.login-form')
        </div>
    </div>

    <!-- =========================
         MODAL REGISTER
    ========================== -->
    <div x-show="showRegister"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

        <div class="relative w-full max-w-md mx-auto" @click.stop>

            <button
                @click="closeAll()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                ✕
            </button>
        </div>
    </div>

    <!-- =========================
         MAIN CONTENT
    ========================== -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">

            {{-- FLASH --}}


            @yield('content')
        </div>
    </main>

    @stack('scripts')



    <!-- =========================
         FLASH AUTO HIDE
    ========================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');

            flashMessages.forEach(function(message) {
                setTimeout(function() {
                    message.classList.add('opacity-0');
                    setTimeout(() => message.remove(), 500);
                }, 4000);
            });
        });
    </script>

</body>

</html>