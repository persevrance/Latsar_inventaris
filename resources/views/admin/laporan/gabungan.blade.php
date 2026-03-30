@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <div class="flex flex-row gap-4 p-2 justify-between">
        <h1 class="text-xl font-bold mb-4">Laporan Peminjaman dan Pengembalian</h1>
        <a href="{{ route('admin.laporan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>

    <form method="GET" class="mb-4 flex gap-2">
        <input type="date" name="tanggal_awal" class="border p-2">
        <input type="date" name="tanggal_akhir" class="border p-2">
        <button class="bg-blue-500 text-white px-4">Filter</button>
    </form>

    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th class="p-2">Nama Peminjam</th>
                <th class="p-2">Kode Barang</th>
                <th class="p-2">Nama Barang</th>
                <th class="p-2">Kode Item</th>
                <th class="p-2">Kategori</th>
                <th class="p-2">Lokasi</th>
                <th class="p-2">Tanggal Pinjam</th>
                <th class="p-2">Tanggal Kembali</th>
                <th class="p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class="text-center">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2 text-left">{{ $item->peminjaman->user->nama }}</td>
                <td class="p-2">{{ $item->barangItem->barang->kode_barang ?? '-' }}</td>
                <td class="p-2 text-left">{{ $item->barangItem->barang->nama_barang ?? '-' }}</td>
                <td class="p-2 text-left">{{ $item->barangItem->kode_item ?? '-' }}</td>
                <td class="p-2 text-left">{{ $item->barangItem->barang->kategori->nama_kategori ?? '-' }}</td>
                <td class="p-2 text-left">{{ $item->barangItem->lokasi->nama_lokasi ?? '-' }}</td>
                <td class="p-2">{{ formatDatetime($item->peminjaman->tanggal_pinjam) }}</td>
                <td class="p-2">
                    {{ formatDatetime($item->pengembalianDetail->pengembalian->tanggal_kembali ?? '-') }}
                </td>
                <td class="p-2">
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