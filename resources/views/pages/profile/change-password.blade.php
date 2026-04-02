@extends('layouts.app')

@section('content')
<div x-data="{ show1:false, show2:false, show3:false }"
    class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-semibold mb-6">
        Ganti Password
    </h2>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        @method('PUT')

        {{-- Password Lama --}}
        <div class="mb-4">
            <label class="block text-sm mb-1">Password Lama</label>

            <div class="relative group">
                <input
                    :type="show1 ? 'text' : 'password'"
                    name="current_password"
                    class="w-full border px-3 py-2 rounded-lg pr-10"
                    required>

                <button type="button"
                    @click="show1 = !show1"
                    class="absolute right-3 top-2.5 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition">

                    <svg x-show="!show1" class="w-4 h-4 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="3" stroke-width="2" />
                        <path stroke-width="2" d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z" />
                    </svg>

                    <svg x-show="show1" class="w-4 h-4 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" d="M3 3l18 18" />
                        <circle cx="12" cy="12" r="3" stroke-width="2" />
                        <path stroke-width="2" d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z" />
                    </svg>
                </button>
            </div>

            @error('current_password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Baru --}}
        <div class="mb-4">
            <label class="block text-sm mb-1">
                Password Baru <span class="text-xs text-gray-400">(min. 8 karakter)</span>
            </label>

            <div class="relative group">
                <input
                    :type="show2 ? 'text' : 'password'"
                    name="password"
                    minlength="8"
                    class="w-full border px-3 py-2 rounded-lg pr-10"
                    required>

                <button type="button"
                    @click="show2 = !show2"
                    class="absolute right-3 top-2.5 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition">

                    <svg x-show="!show2" class="w-4 h-4 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="3" stroke-width="2" />
                        <path stroke-width="2" d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z" />
                    </svg>

                    <svg x-show="show2" class="w-4 h-4 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" d="M3 3l18 18" />
                        <circle cx="12" cy="12" r="3" stroke-width="2" />
                        <path stroke-width="2" d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z" />
                    </svg>
                </button>
            </div>

            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div class="mb-6">
            <label class="block text-sm mb-1">Konfirmasi Password</label>

            <div class="relative group">
                <input
                    :type="show3 ? 'text' : 'password'"
                    name="password_confirmation"
                    minlength="8"
                    class="w-full border px-3 py-2 rounded-lg pr-10"
                    required>

                <button type="button"
                    @click="show3 = !show3"
                    class="absolute right-3 top-2.5 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition">

                    <svg x-show="!show3" class="w-4 h-4 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="3" stroke-width="2" />
                        <path stroke-width="2" d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z" />
                    </svg>

                    <svg x-show="show3" class="w-4 h-4 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" d="M3 3l18 18" />
                        <circle cx="12" cy="12" r="3" stroke-width="2" />
                        <path stroke-width="2" d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z" />
                    </svg>
                </button>
            </div>
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
@endsection