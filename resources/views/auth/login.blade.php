@extends('layouts.auth')

@section('content')

<section class="w-full max-w-7xl bg-white dark:bg-gray-900 rounded-lg shadow-lg overflow-hidden">
    <div class="grid md:grid-cols-2">

        {{-- LEFT CONTENT --}}
        <div class="p-10 flex flex-col justify-center space-y-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                Inventaris Barang <br>
                <span class="text-blue-600">Politeknik Negeri Bali</span>
            </h1>

            <p class="text-gray-600 dark:text-gray-400">
                Sistem inventaris terpusat untuk pengelolaan barang,
                monitoring kondisi, dan pencatatan peminjaman secara terintegrasi.
            </p>

            <img src="{{ asset('img/login-img.svg') }}" class="w-72 mt-6" alt="">
        </div>

        {{-- RIGHT FORM --}}
        <div class="p-10 flex items-center justify-center bg-gray-50 dark:bg-gray-800">

            @include('auth.partials.login-form')

        </div>

    </div>
</section>

@endsection