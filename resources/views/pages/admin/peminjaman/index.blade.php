@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
<h1 class="text-xl font-bold mb-4">Data Peminjaman</h1>

<x-ui.table>
    <x-slot name="head">
        <th class="p-2">No</th>
        <th class="p-2">Peminjam</th>
        <th class="p-2">Nama Barang</th>
        <th class="p-2">Kode Item</th>
        <th class="p-2">Tanggal Pinjam</th>
        <th class="p-2">Rencana Tanggal Kembali</th>
        <th class="p-2">Status</th>
        <th class="p-2">Aksi</th>
    </x-slot>

    <x-slot name="body">
        @foreach($data as $p)
        <tr class="border-t text-center">
            <td class="p-2">{{ $loop->iteration }}</td>
            <td class="p-2 text-left">{{ $p->user->nama }}</td>
            <td class="p-2 text-left">
                {{ $p->details->first()->barangItem->barang->nama_barang ?? '-' }}
            </td>
            <td class="p-2">
                {{ $p->details->first()->barangItem->kode_item ?? '-' }}
            </td>
            <td class="p-2">{{ $p->tanggal_pinjam }}</td>
            <td class="p-2">{{ $p->tanggal_kembali_rencana }}</td>
            <td class="p-2">
                <x-inventory.status-badge :status="$p->status" />
            </td>
            <td class="p-2">
                <a href="{{ route('admin.peminjaman.show', $p->id) }}">
                    <x-ui.button variant="secondary">Detail</x-ui.button>
                </a>
            </td>
        </tr>
        @endforeach
    </x-slot>
</x-ui.table>
@endsection