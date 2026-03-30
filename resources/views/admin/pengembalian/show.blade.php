@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <div class="flex flex-row items-center justify-between p-2 m-2">
        <div class="p-2 text-lg font-bold">
            Detail Pengembalian
        </div>
        <div class="flex flex-row justify-end items-center gap-2">
            <a href="{{ route('admin.peminjaman.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                Kembali
            </a>
        </div>
    </div>
    <div class="bg-white p-4 rounded shadow space-y-2">
        <p><strong>ID Peminjaman:</strong> {{ $peminjaman->id }}</p>
        <p><strong>Peminjam:</strong> {{ $peminjaman->user->nama }}</p>
        <p><strong>Tanggal Kembali:</strong>
            {{ formatTanggal($peminjaman->pengembalian->tanggal_kembali) }}
        </p>
        <p><strong>Diterima Oleh:</strong>
            {{ $peminjaman->pengembalian->penerima->nama ?? '-' }}
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold mb-3">Detail Barang</h2>

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">No</th>
                    <th class="p-2 text-left">Kode - Nama Barang</th>
                    <th class="p-2 text-left">Kode Item</th>
                    <th class="p-2 text-left">Kondisi</th>
                    <th class="p-2 text-left">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @if($peminjaman->pengembalian && $peminjaman->pengembalian->details->count())
                @foreach($peminjaman->pengembalian->details as $detail)
                <tr class="border-t">
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $detail->barangItem->barang->kode_barang }} - {{ $detail->barangItem->barang->nama_barang ?? '-' }}</td>
                    <td class="p-2">{{ $detail->barangItem->kode_item ?? '-' }}</td>
                    <td class="p-2">{{ $detail->kondisi_kembali ?? '-' }}</td>
                    <td class="p-2">{{ $detail->catatan ?? '-' }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3" class="text-center text-gray-400 p-3">
                        Detail belum tersedia
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection