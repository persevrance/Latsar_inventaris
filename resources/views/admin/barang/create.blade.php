@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Tambah Barang Item</h1>

<form method="POST" action="/admin/barang-item">
    @csrf

    <input name="kode_item" class="border p-2 w-full mb-2" placeholder="Kode Item">
    @error('kode_item') <small class="text-red-500">{{ $message }}</small> @enderror

    <select name="barang_id" class="border p-2 w-full mb-2">
        @foreach($barang as $b)
        <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
        @endforeach
    </select>

    <select name="lokasi_id" class="border p-2 w-full mb-2">
        @foreach($lokasi as $l)
        <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
        @endforeach
    </select>

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@endsection