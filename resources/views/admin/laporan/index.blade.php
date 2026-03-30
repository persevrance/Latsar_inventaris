@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <h1 class="text-2xl font-bold mb-6">Menu Laporan</h1>

    <div class="grid grid-cols-4 gap-4">
        <div class="bg-white hover:bg-gray-100 p-4 shadow rounded">
            <a href="{{ route('admin.laporan.barang') }}">
                <h2 class="font-semibold">Laporan Barang</h2>
            </a>
        </div>
        <div class="bg-white hover:bg-gray-100 p-4 shadow rounded">
            <a href="{{ route('admin.laporan.peminjaman') }}">
                <h2 class="font-semibold">Laporan Peminjaman</h2>
            </a>
        </div>
        <div class="bg-white hover:bg-gray-100 p-4 shadow rounded">
            <a href="{{ route('admin.laporan.pengembalian') }}">
                <h2 class="font-semibold">Laporan Pengembalian</h2>
            </a>
        </div>
        <div class="bg-white hover:bg-gray-100 p-4 shadow rounded">
            <a href="{{ route('admin.laporan.gabungan') }}">
                <h2 class="font-semibold">Laporan Gabungan</h2>
            </a>
        </div>
    </div>

</div>
@endsection