@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <h1 class="text-xl font-bold mb-4">Arsip Barang</h1>

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-sm">
                <th class="p-2">No</th>
                <th class="p-2">Nama Barang</th>
                <th class="p-2">Kode</th>
                <th class="p-2">Jumlah Item</th>
                <th class="p-2">Tanggal Arsip</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $row)
            <tr class="border-t text-sm text-center hover:bg-gray-50">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $row->nama_barang }}</td>
                <td class="p-2">{{ $row->kode_barang }}</td>
                <td class="p-2">{{ $row->items_count }}</td>
                <td class="p-2">
                    {{ formatTanggal($row->created_at) }}
                </td>
                <td class="p-2">
                    <a href="{{ route('barang.arsip.show', $row->id) }}"
                        class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                        Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-4 text-gray-500 text-center">
                    Belum ada data arsip
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection