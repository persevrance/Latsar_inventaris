@extends('layouts.app')

@section('content')
<div class="px-6 md:px-16 py-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold">Barang Tersedia</h1>
            <p class="text-sm text-gray-500">Daftar barang yang dapat dipinjam</p>
        </div>

        <!-- Search -->
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" placeholder="Cari barang..."
                class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring w-64">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
                Cari
            </button>
            <button type="button" onclick="window.location.href=`{{ route('pegawai.barang') }}`" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-400">
                Reset
            </button>
        </form>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Barang</p>
            <h2 class="text-xl font-bold">{{ $data->count() }}</h2>
        </div>

        <div class="bg-green-50 p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Status</p>
            <h2 class="text-xl font-bold text-green-600">Ready</h2>
        </div>

        <!-- <div class="bg-blue-50 p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Aksi</p>
            <h2 class="text-sm text-blue-600 font-semibold">Klik untuk pinjam</h2>
        </div> -->
    </div>

    <!-- Grid Barang -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">

        @forelse($data as $row)
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">

            <!-- Nama -->
            <h2 class="font-semibold text-lg mb-1">
                {{ $row->barang->nama_barang }}
            </h2>

            <!-- Kode -->
            <p class="text-xs text-gray-500 mb-2">
                Kode: {{ $row->barang->kode_barang ?? '-' }}
            </p>

            <!-- Status -->
            @php
            $status = $row->status;
            @endphp

            @if($status == 'tersedia')
            <span class="inline-block text-xs px-2 py-1 rounded bg-green-100 text-green-700 mb-3">
                Tersedia
            </span>
            @elseif($status == 'dipinjam')
            <span class="inline-block text-xs px-2 py-1 rounded bg-red-100 text-red-700 mb-3">
                Dipinjam
            </span>
            @elseif($status == 'maintenance')
            <span class="inline-block text-xs px-2 py-1 rounded bg-yellow-100 text-yellow-700 mb-3">
                Maintenance
            </span>
            @elseif($status == 'nonaktif')
            <span class="inline-block text-xs px-2 py-1 rounded bg-gray-200 text-gray-700 mb-3">
                Nonaktif
            </span>
            @endif

            <!-- Action -->
            @if($row->status == 'tersedia')
            <a href="{{ url('/pegawai/peminjaman/create?barang='.$row->id) }}"
                class="block text-center bg-blue-500 text-white py-2 rounded-lg text-sm hover:bg-blue-600">
                Pinjam
            </a>
            @else
            <button disabled
                class="block w-full text-center bg-gray-300 text-gray-500 py-2 rounded-lg text-sm cursor-not-allowed">
                Tidak tersedia
            </button>
            @endif

        </div>
        @empty
        <div class="col-span-full text-center text-gray-500">
            Tidak ada barang tersedia
        </div>
        @endforelse

    </div>

</div>
@endsection