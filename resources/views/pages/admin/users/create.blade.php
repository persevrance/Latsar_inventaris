@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-xl font-semibold mb-4">Tambah User</h1>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama"
                class="w-full border rounded px-3 py-2"
                value="{{ old('nama') }}">
            @error('nama')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email"
                class="w-full border rounded px-3 py-2"
                value="{{ old('email') }}">
            @error('email')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" name="password"
                class="w-full border rounded px-3 py-2">
            @error('password')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-4">
            <label class="block mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="w-full border rounded px-3 py-2">
        </div>

        {{-- Role --}}
        <div class="mb-4">
            <label class="block mb-1">Role</label>
            <select name="role" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
            </select>
            @error('role')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex justify-end gap-2">

            <x-ui.button type="button" onclick="confirmSubmit()" label="Simpan" />
        </div>

    </form>
</div>

<script>
    function confirmSubmit() {
        Swal.fire({
            title: 'Simpan User?',
            text: "Data user akan ditambahkan",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('form').submit();
            }
        });
    }
</script>
@endsection