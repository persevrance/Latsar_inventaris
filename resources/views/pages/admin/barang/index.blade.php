@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-xl font-bold">Data Barang</h1>

    <a href="{{ route('admin.barang.create') }}">
        <x-ui.button>Tambah Barang</x-ui.button>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($barang as $b)
    <x-inventory.barang-card :barang="$b" />
    @endforeach
</div>
@endsection