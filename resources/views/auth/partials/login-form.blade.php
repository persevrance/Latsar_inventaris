<div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 space-y-6">

    <div class="flex flex-col justify-center items-center space-y-1 my-4">
        <img src="{{ asset('img/logopnb.png') }}" class="h-16 w-auto" alt="Logo PNB" />
    </div>
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
        Masuk
    </h2>

    {{-- ERROR --}}
    @if ($errors->any())
    <div class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-sm rounded-md p-3">
        {{ $errors->first() }}
    </div>
    @endif

    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Username --}}
        <div>
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Username
            </label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan email Anda" required autofocus autocomplete="email">
        </div>

        {{-- Password --}}
        <div>
            <label for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required autocomplete="current-password">
                <button type="button" onclick="togglePassword()" tabindex="-1"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-gray-300">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Remember me & Forgot --}}
        <div class="flex items-center justify-between">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" name="remember" type="checkbox"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="text-gray-500 dark:text-gray-300">Ingat saya?</label>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 transition duration-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Masuk
        </button>
    </form>

</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            // Eye-slash Heroicon
            eyeIcon.outerHTML = `
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.95-.138 2.85-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.5a10.45 10.45 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l12.544 12.544M9.88 9.88a3 3 0 104.24 4.24" />
                    </svg>
                `;
        } else {
            passwordInput.type = "password";
            // Eye Heroicon
            eyeIcon.outerHTML = `
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                `;
        }
    }

    // Auto-close alert after 5 seconds
    setTimeout(() => {
        const alert = document.getElementById('error-alert');
        if (alert) alert.style.display = 'none';
    }, 5000);
</script>