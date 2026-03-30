@extends('layouts.app')

@section('content')
<div class="px-6 md:px-16 py-6 space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold">Dashboard Pegawai</h1>
        <p class="text-gray-500 text-sm">Ringkasan aktivitas peminjaman Anda</p>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

        <!-- Total Barang -->
        <div class="bg-white p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Barang</p>
            <h2 class="text-2xl font-bold">{{ $total_barang }}</h2>
        </div>

        <!-- Barang Ready -->
        <div class="bg-green-50 p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Barang Ready</p>
            <h2 class="text-2xl font-bold text-green-600">{{ $barang_ready }}</h2>
        </div>

        <!-- Peminjaman Aktif -->
        <div class="bg-blue-50 p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Peminjaman Aktif</p>
            <h2 class="text-2xl font-bold text-blue-600">{{ $peminjaman_aktif }}</h2>
        </div>

        <!-- Pending -->
        <div class="bg-yellow-50 p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Menunggu Approval</p>
            <h2 class="text-2xl font-bold text-yellow-600">{{ $pending }}</h2>
        </div>

        <!-- History -->
        <div class="bg-gray-100 p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Riwayat Selesai</p>
            <h2 class="text-2xl font-bold text-gray-700">{{ $history }}</h2>
        </div>

    </div>

    <!-- Quick Action -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4">Aksi Cepat</h2>

        <div class="flex flex-wrap gap-3">
            <a href="{{ url('/pegawai/barang') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">
                Lihat Barang Ready
            </a>

            <a href="{{ url('/pegawai/peminjaman') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                Ajukan Peminjaman
            </a>

            <a href="{{ url('/pegawai/history') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm">
                Riwayat Peminjaman
            </a>
        </div>
    </div>

    <!-- Info -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
        <p class="text-sm text-yellow-700">
            Status peminjaman:
            <span class="font-semibold">Pending</span> → Menunggu persetujuan,
            <span class="font-semibold">Approved</span> → Disetujui,
            <span class="font-semibold">Returned</span> → Sudah dikembalikan
        </p>
    </div>

</div>
@endsection