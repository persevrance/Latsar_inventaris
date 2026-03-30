@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <h1 class="text-2xl font-bold mb-6">Laporan</h1>

    <div class="grid grid-cols-3 gap-4">
        <a href="{{ route('admin.laporan.barang') }}" class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold">Laporan Barang</h2>
        </a>

        <a href="{{ route('admin.laporan.peminjaman') }}" class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold">Laporan Peminjaman</h2>
        </a>

        <a href="{{ route('admin.laporan.pengembalian') }}" class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold">Laporan Pengembalian</h2>
        </a>
        <a href="{{ route('admin.laporan.gabungan') }}" class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold">Laporan Gabungan</h2>
        </a>
    </div>

</div>
@endsection