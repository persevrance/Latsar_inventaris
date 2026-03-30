@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <h1 class="text-xl font-bold mb-4">Laporan Barang</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->barang->kode_barang ?? '-' }}</td>
                <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                <td>{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $item->lokasi->nama ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection