@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Barang</h1>

<form method="POST" action="{{ route('admin.barang.update', $barang->id) }}">
    @csrf
    @method('PUT')

    <x-ui.form-input
        label="Nama Barang"
        name="nama_barang"
        :value="$barang->nama_barang" />

    <x-ui.button type="submit">Update</x-ui.button>
</form>
@endsection