@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">Detail Barang</h1>

        <div>
            <a href="{{ route('barang.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </div>

    </div>

    {{-- INFO BARANG --}}
    <div class="bg-white shadow rounded p-4 space-y-2">
        <div><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</div>
        <div><strong>Kode:</strong> {{ $barang->kode_barang }}</div>
        <div>
            <strong>Lokasi Penyimpanan:</strong>
            {{ $barang->lokasi->nama_lokasi ?? 'Tidak ada lokasi' }}
        </div>
        <div>
            <strong>Total Item:</strong>
            <span class="bg-gray-200 px-2 py-1 rounded text-sm">
                {{ $barang->items->count() }}
            </span>
        </div>
    </div>

    {{-- TABEL ITEM --}}
    <div class="bg-white shadow rounded">
        <div class="flex flex-row items-center justify-between p-2 m-2">
            <div class="p-4 font-semibold border-b">
                List Item
            </div>
            <div class="flex flex-row justify-end items-center gap-2">
                <a href="{{ route('barang-item.create', ['barang_id' => $barang->id]) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                    Tambah Item
                </a>
                <div>

                </div>
            </div>

        </div>


        <table class="w-full">
            <thead>
                <tr class="bg-gray-100 text-sm">
                    <th class="p-2">No</th>
                    <th class="p-2">Kode Item</th>
                    <th class="p-2">Rak</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Peminjam</th>
                    <th class="p-2">Tanggal Pinjam</th>
                    <th class="p-2">Lokasi Saat Ini</th>
                </tr>
            </thead>

            <tbody>
                @forelse($barang->items as $item)
                <tr class="border-t text-sm text-center hover:bg-gray-50">
                    <td class="p-2 text-center">{{ $loop->iteration }}</td>

                    <td class="p-2">
                        {{ $item->kode_item }}
                    </td>

                    <td class="p-2">
                        {{ $item->rak ?? '-' }}
                    </td>

                    {{-- STATUS --}}
                    <td class="p-2">
                        @switch($item->status)

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

                    {{-- PEMINJAM --}}
                    <td class="p-2">
                        @if($item->peminjamanAktif)
                        {{ $item->peminjamanAktif->user->nama ?? '-' }}
                        @else
                        -
                        @endif
                    </td>

                    {{-- TANGGAL PINJAM --}}
                    <td class="p-2">
                        @if($item->peminjamanAktif && $item->peminjamanAktif->tanggal_pinjam)
                        {{ \Carbon\Carbon::parse($item->peminjamanAktif->tanggal_pinjam)->format('d-m-Y') }}
                        @else
                        -
                        @endif
                    </td>

                    {{-- LOKASI DINAMIS --}}
                    <td class="p-2">
                        @if($item->status == 'dipinjam')
                        {{ $item->lokasi->nama_lokasi ?? 'Dipinjam' }}
                        @else
                        {{ $barang->lokasi->nama_lokasi ?? 'Gudang' }}
                        @if($item->rak)
                        (Rak {{ $item->rak }})
                        @endif
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">
                        Belum ada item
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection