@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Tambah User</h1>

<form method="POST" action="/admin/users">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="border p-2 w-full">
        @error('nama') <small class="text-red-500">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="border p-2 w-full">
        @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="border p-2 w-full">
    </div>

    <div class="mb-3">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="border p-2 w-full">
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="border p-2 w-full">
            <option value="pegawai">Pegawai</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Simpan
    </button>

</form>
@endsection