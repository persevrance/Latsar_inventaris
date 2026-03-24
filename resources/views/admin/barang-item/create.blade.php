@extends('layouts.app')

@section('content')
<h1 class="text-xl mb-4">Tambah Item</h1>

<form method="POST" action="/admin/barang-item">
    @csrf

    <input name="kode_item" class="border p-2 w-full mb-2">

    <select name="barang_id" class="border p-2 w-full mb-2">
        @foreach($barang as $b)
        <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
        @endforeach
    </select>

    <button class="bg-green-500 text-white px-4 py-2">Simpan</button>

</form>
@endsection