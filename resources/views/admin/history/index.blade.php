@extends('layouts.app')

@section('content')

<div class="px-4 md:px-24 py-6 space-y-6">
    <h1 class="text-xl font-bold mb-4">History Barang</h1>

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th class="p-2">Kode Barang</th>
                <th class="p-2">Nama Barang</th>
                <th class="p-2">Kode Item</th>
                <th class="p-2">Kategori</th>
                <th class="p-2">Lokasi</th>
                <th class="p-2">Aktivitas</th>
                <th class="p-2">Deskripsi</th>
                <th class="p-2">Tanggal Perubahan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr class="border-t text-center">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $row->barangItem->barang->kode_barang ?? '-' }}</td>
                <td class="p-2 text-left">{{ $row->barangItem->barang->nama_barang ?? '-' }}</td>
                <td class="p-2">{{ $row->barangItem->kode_item ?? '-' }}</td>
                <td class="p-2 text-left">{{ $row->barangItem->barang->kategori->nama_kategori ?? '-' }}</td>
                <td class="p-2 text-left">{{ $row->barangItem->lokasi->nama_lokasi ?? '-' }}</td>
                <td class="p-2 text-left">{{ $row->aktivitas }}</td>
                <td class="p-2 text-left">
                    {{ $row->barangItem->detailPengembalian->first()->catatan ?? '-' }}
                </td>
                <td class="p-2">{{ formatTanggal($row->tanggal) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection