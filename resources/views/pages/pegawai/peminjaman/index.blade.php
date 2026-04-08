@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="flex flex-row justify-between p-4 ">
    <h1 class="text-xl font-bold">Riwayat Peminjaman</h1>

    <x-ui.button href="{{ route('pegawai.peminjaman.create') }}"
        variant="primary"
        label="Ajukan Peminjaman" />
</div>

<div class="bg-white shadow rounded overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">ID Pinjam</th>
                <th class="px-4 py-2">Barang</th>
                <th class="px-4 py-2">Kode Item</th>
                <th class="px-4 py-2">Tanggal Peminjaman</th>
                <th class="px-4 py-2">Tanggal Pengembalian</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($data as $p)
            @foreach($p->details as $d)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-2 font-semibold">
                    {{ $loop->parent->iteration }}
                </td>
                <td class="px-4 py-2">
                    {{ $p->id }}
                </td>
                <td class="px-4 py-2 font-semibold">
                    {{ $d->barangItem->barang->nama_barang ?? '-' }}
                </td>
                <td class="px-4 py-2">
                    {{ $d->barangItem->kode_item ?? '-' }}
                </td>
                <td class="px-4 py-2">
                    {{ $p->tanggal_pinjam }}
                </td>
                <td class="px-4 py-2">
                    {{ $p->pengembalian->tanggal_kembali ?? '-' }}
                </td>
                <td class="px-4 py-2">
                    <x-inventory.status-badge :status="$p->status" />
                </td>
            </tr>
            @endforeach
            @empty
            <tr>
                <td colspan="3" class="text-center px-4 py-4 text-gray-500">
                    Tidak ada data peminjaman
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection