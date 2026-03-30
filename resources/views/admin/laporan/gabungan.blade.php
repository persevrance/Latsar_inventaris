@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <h1 class="text-xl font-bold mb-4">Laporan Peminjaman & Pengembalian</h1>

    <form method="GET" class="mb-4 flex gap-2">
        <input type="date" name="tanggal_awal" class="border p-2">
        <input type="date" name="tanggal_akhir" class="border p-2">
        <button class="bg-blue-500 text-white px-4">Filter</button>
    </form>

    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th>User</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->peminjaman->user->nama }}</td>
                <td>{{ $item->barangItem->barang->kode_barang ?? '-' }}</td>

                <td>{{ $item->barangItem->barang->nama_barang ?? '-' }}</td>

                <td>{{ $item->barangItem->barang->kategori->nama_kategori ?? '-' }}</td>

                <td>{{ $item->barangItem->lokasi->nama_lokasi ?? '-' }}</td>

                <td>{{ $item->peminjaman->tanggal_pinjam }}</td>

                <td>
                    {{ $item->pengembalianDetail->pengembalian->tanggal_kembali ?? '-' }}
                </td>

                <td>
                    @if($item->pengembalianDetail)
                    <span class="text-green-600 font-semibold">Dikembalikan</span>
                    @else
                    <span class="text-red-600 font-semibold">Belum</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection