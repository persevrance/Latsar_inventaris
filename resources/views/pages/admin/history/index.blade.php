@extends('layouts.app')

@section('title', 'History Barang')

@section('content')
<div class="p-6">

    <h1 class="text-xl font-bold mb-4">History Barang</h1>

    {{-- FILTER --}}
    <form method="GET" class="flex gap-3 mb-4 flex-wrap">

        <select name="barang_id" class="border rounded px-3 py-2">
            <option value="">Semua Barang</option>
            @foreach($barangs as $barang)
            <option value="{{ $barang->id }}">
                {{ $barang->nama_barang }}
            </option>
            @endforeach
        </select>

        <select name="aktivitas" class="border rounded px-3 py-2">
            <option value="">Semua Aktivitas</option>
            <option value="dipinjam">Dipinjam</option>
            <option value="dikembalikan">Dikembalikan</option>
            <option value="rusak">Rusak</option>
        </select>

        <input type="date" name="tanggal" class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>
    </form>

    {{-- TABLE --}}
    <table class="w-full border shadow rounded text-sm rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-gray-700">
            <tr class="text-center">
                <th class="p-3">No</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Barang</th>
                <th class="p-3">Kode Item</th>
                <th class="p-3">Aktivitas</th>
                <th class="p-3">Kondisi</th>
                <th class="p-3">Catatan</th>
                <th class="p-3">Penanggung Jawab</th>
            </tr>
        </thead>

        <tbody>
            @forelse($histories as $history)
            <tr class="border-t hover:bg-gray-50 transition text-center">

                <td class="p-3">
                    {{ $loop->iteration }}
                </td>

                {{-- TANGGAL --}}
                <td class="p-3 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($history->tanggal)->format('d M Y H:i') }}
                </td>

                {{-- BARANG --}}
                <td class="p-3 font-medium text-left">
                    <a href="{{ route('admin.history.barang.show', $history->barangItem->barang->id) }}"
                        class="hover:underline">
                        {{ $history->barangItem->barang->nama_barang ?? '-' }}
                    </a>
                </td>

                {{-- ITEM --}}
                <td class="p-3 font-medium ">
                    <a href="{{ route('admin.history.item.show', $history->barangItem->id) }}"
                        class="hover:underline">
                        {{ $history->barangItem->kode_item ?? '-' }}
                    </a>
                </td>

                {{-- AKTIVITAS --}}
                <td class="p-3">
                    @php
                    $colors = [
                    'dipinjam' => 'bg-blue-100 text-blue-700',
                    'dikembalikan' => 'bg-green-100 text-green-700',
                    'perubahan_kondisi' => 'bg-yellow-100 text-yellow-700',
                    'dipindahkan' => 'bg-purple-100 text-purple-700',
                    ];
                    @endphp

                    <span class="px-2 py-1 rounded text-xs font-semibold {{ $colors[$history->aktivitas] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst(str_replace('_', ' ', $history->aktivitas)) }}
                    </span>
                </td>

                {{-- KONDISI --}}
                <td class="p-3">
                    <div class="flex items-center gap-2 text-xs">

                        <span class="px-2 py-1 rounded bg-gray-100">
                            {{ $history->kondisi_awal ?? '-' }}
                        </span>

                        <span>→</span>

                        <span class="px-2 py-1 rounded bg-gray-100 font-semibold">
                            {{ $history->kondisi_akhir ?? '-' }}
                        </span>

                    </div>
                </td>

                {{-- Catatan --}}
                <td class="p-3 text-xs text-gray-600">
                    <span class="px-2 py-1 rounded">
                        {{ $history->detailPengembalian->catatan ?? '-' }}
                    </span>
                </td>

                {{-- USER --}}
                <td class="p-3 text-gray-700">
                    {{ $history->actor->nama ?? '-' }}
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center p-6 text-gray-500">
                    Tidak ada data history
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $histories->links() }}
    </div>

</div>
@endsection