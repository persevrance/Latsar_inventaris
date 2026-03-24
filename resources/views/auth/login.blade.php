@extends($layout ?? 'layouts.auth')

@section('content')

<section class="relative overflow-hidden bg-gray-50 dark:bg-gray-900 rounded-lg shadow-lg">
    <div class="max-w-7xl mx-auto px-6 md:px-24 py-20 grid md:grid-cols-2 gap-12 items-center">

        {{-- LEFT CONTENT --}}
        <div class="space-y-6">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-900 dark:text-white">
                Inventaris Barang <br>
                <span class="text-blue-600">Politenik Negeri Bali</span>
                Lebih Terintegrasi dan Akurat
            </h1>

            <p class="text-gray-600 dark:text-gray-400 max-w-xl">
                Sistem inventaris terpusat untuk pengelolaan barang di UPA-TIK Politeknik Negeri Bali,
                mencakup data barang, lokasi, kondisi, hingga laporan inventaris
                secara efisien dan transparan.
            </p>

            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}"
                    @click.prevent="showLogin = true"
                    class="px-4 py-2 w-full text-center bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700">
                    Masuk </a>
            </div>
        </div>

        {{-- RIGHT VISUAL --}}
        <div class="relative flex justify-center">

            {{-- Background circle --}}
            <div class="absolute w-80 h-80 rounded-full bg-blue-100
                        dark:bg-blue-900/30 -z-10"></div>

            {{-- Main illustration (placeholder avatar / illustration) --}}

            <img src="{{ asset('img/login-img.svg') }}" alt="">

        </div>
    </div>
</section>


@endsection