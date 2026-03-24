@extends('layouts.pegawai')

@section('content')
<h1 class="text-xl mb-4">Ajukan Peminjaman</h1>

<form method="POST" action="/pegawai/peminjaman">
    @csrf

    @foreach($barang as $item)
    <label class="block">
        <input type="checkbox" name="barang_item_id[]" value="{{ $item->id }}">
        {{ $item->kode_item }}
    </label>
    @endforeach

    <button class="bg-blue-500 text-white px-4 py-2 mt-4">
        Ajukan
    </button>

</form>
@endsection