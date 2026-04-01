@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<h1 class="text-xl font-bold mb-4">Tambah Barang</h1>

<form method="POST" action="{{ route('admin.barang.store') }}">
    @csrf

    <x-ui.form-input label="Nama Barang" name="nama_barang" />

    <div class="mb-4">
        <label class="block text-sm mb-1">Kategori</label>
        <select name="kategori_id" class="w-full border p-2 rounded">
            @foreach($kategori as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-sm mb-1">Lokasi Penyimpanan</label>
        <select name="lokasi_id" class="w-full border p-2 rounded">
            @foreach($lokasi as $l)
            <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
            @endforeach
        </select>
    </div>

    <x-ui.button type="submit" label="Simpan" variant="primary" />
    <x-ui.button type="button" label="Batal" variant="outline" onclick="window.history.back()" />
</form>
@endsection