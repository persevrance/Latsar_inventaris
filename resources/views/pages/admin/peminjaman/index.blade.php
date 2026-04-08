@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
<div class="flex flex-row justify-between gap-4 my-4">
    <h1 class="text-xl font-bold mb-4">Data Peminjaman</h1>
    <form method="GET" action="{{ route('admin.peminjaman.index') }}" class="mb-4 flex gap-2">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari ID Peminjaman..."
            class="border px-3 py-2 rounded w-64">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Cari
        </button>

        @if(request('search'))
        <a href="{{ route('admin.peminjaman.index') }}" class="px-4 py-2 border rounded">
            Reset
        </a>
        @endif
    </form>
</div>

<x-ui.table>
    <x-slot name="head">
        <th class="p-2">No</th>
        <th class="p-2">ID Pinjam</th>
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
            <td class="p-2">{{ $p->id }}</td>
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