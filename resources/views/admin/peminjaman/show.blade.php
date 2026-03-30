@extends('layouts.app')

@section('content')

<div class="px-4 md:px-24 py-6 space-y-6">
    <h1 class="text-2xl font-bold mb-6">Detail Peminjaman</h1>

    {{-- INFO PEMINJAMAN --}}
    <div class="bg-white p-4 rounded shadow mb-4">
        <h2 class="font-semibold mb-2">Informasi Peminjaman</h2>

        <div class="grid grid-cols-2 gap-2 text-sm">
            <p><strong>ID:</strong> {{ $data->id }}</p>
            <p><strong>Status:</strong>
                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-800">
                    {{ $data->status }}
                </span>
            </p>

            <p><strong>Tanggal Pengajuan:</strong>
                {{ $data->tanggal_pengajuan?->format('d-m-Y') }}
            </p>

            <p><strong>Tanggal Pinjam:</strong>
                {{ $data->tanggal_pinjam?->format('d-m-Y') }}
            </p>

            <p><strong>Rencana Kembali:</strong>
                {{ $data->tanggal_kembali_rencana?->format('d-m-Y') }}
            </p>

            <p><strong>Keterangan:</strong>
                {{ $data->keterangan ?? '-' }}
            </p>
        </div>
    </div>

    {{-- DATA PEMINJAM --}}
    <div class="bg-white p-4 rounded shadow mb-4">
        <h2 class="font-semibold mb-2">Data Peminjam</h2>

        <p><strong>Nama:</strong> {{ $data->user->nama ?? '-' }}</p>
        <p><strong>Email:</strong> {{ $data->user->email ?? '-' }}</p>
    </div>

    {{-- LIST BARANG --}}
    <div class="bg-white p-4 rounded shadow mb-4">
        <h2 class="font-semibold mb-3">Daftar Barang</h2>

        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Kode Item</th>
                    <th class="p-2 border">Nama Barang</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data->details as $index => $item)
                <tr>
                    <td class="p-2 border text-center">{{ $index + 1 }}</td>
                    <td class="p-2 border">
                        {{ $item->barangItem->kode_item ?? '-' }}
                    </td>
                    <td class="p-2 border">
                        {{ $item->barangItem->barang->nama_barang ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-2 text-center text-gray-500">
                        Tidak ada barang
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ACTION --}}
    <div class="flex gap-2">

        {{-- PROSES --}}
        <form method="POST" action="/admin/peminjaman/{{ $data->id }}/proses">
            @csrf
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Setujui
            </button>
        </form>

        {{-- KEMBALI --}}
        <a href="/admin/peminjaman"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>

    </div>
</div>


@endsection