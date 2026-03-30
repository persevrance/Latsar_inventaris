@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <div class="flex flex-row gap-4 p-2 justify-between">
        <h1 class="text-xl font-bold mb-4">Laporan Barang</h1>
        <a href="{{ route('admin.laporan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th class="p-2">Kode Barang</th>
                <th class="p-2">Nama Barang</th>
                <th class="p-2">Kode Item</th>
                <th class="p-2">Tanggal Input</th>
                <th class="p-2">Kategori</th>
                <th class="p-2">Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class="text-center">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $item->barang->kode_barang ?? '-' }}</td>
                <td class="p-2 text-left">{{ $item->barang->nama_barang ?? '-' }}</td>
                <td class="p-2 text-left">{{ $item->kode_item ?? '-' }}</td>
                <td class="p-2 text-left">{{ formatTanggal($item->created_at) ?? '-' }}</td>
                <td class="p-2 text-left">{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                <td class="p-2 text-left">{{ $item->barang->lokasi->nama_lokasi ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection