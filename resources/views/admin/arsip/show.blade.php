@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">Detail Arsip Barang</h1>

        <a href="{{ route('barang.arsip') }}"
            class="bg-gray-500 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>

    {{-- INFO BARANG --}}
    <div class="bg-white shadow rounded p-4 space-y-2">
        <div><strong>Nama Barang:</strong> {{ $barang['nama_barang'] ?? '-' }}</div>
        <div><strong>Kode:</strong> {{ $barang['kode_barang'] ?? '-' }}</div>
        <div><strong>Jumlah Item:</strong> {{ count($items) }}</div>
        <div><strong>Diarsipkan Pada:</strong>
            {{ formatTanggal($arsip->created_at) }}
        </div>
    </div>

    {{-- TABEL ITEM --}}
    <div class="bg-white shadow rounded">
        <div class="p-4 font-semibold border-b">
            List Item (Snapshot)
        </div>

        <table class="w-full">
            <thead>
                <tr class="bg-gray-100 text-sm text-center">
                    <th class="p-2">No</th>
                    <th class="p-2">Kode Item</th>
                    <th class="p-2">Rak</th>
                    <th class="p-2">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($items as $item)
                <tr class="border-t text-sm text-center hover:bg-gray-50">
                    <td class="p-2">{{ $loop->iteration }}</td>

                    <td class="p-2">
                        {{ $item['kode_item'] ?? '-' }}
                    </td>

                    <td class="p-2">
                        {{ $item['rak'] ?? '-' }}
                    </td>

                    <td class="p-2">
                        @switch($item['status'] ?? '')
                        @case('tersedia')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                            Tersedia
                        </span>
                        @break

                        @case('dipinjam')
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
                            Dipinjam
                        </span>
                        @break

                        @case('maintenance')
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">
                            Maintenance
                        </span>
                        @break

                        @case('nonaktif')
                        <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">
                            Nonaktif
                        </span>
                        @break

                        @default
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">
                            Tidak diketahui
                        </span>
                        @endswitch
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-gray-500 text-center">
                        Tidak ada item
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection