@extends('layouts.app')

@section('title', 'Detail History Barang')

@section('content')
<div class="p-6">
    <div class="flex flex-row justify-between gap-4 my-4">
        <h1 class="text-xl font-bold mb-4">
            History: {{ $barang->nama_barang }}
        </h1>
        <x-ui.button
            label="Kembali"
            variant="outline"
            onclick="window.history.back()" />
    </div>


    <table class="w-full text-sm shadow rounded">
        <thead class="text-center">
            <tr class="bg-gray-100">
                <th class="p-2">No</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Item</th>
                <th class="p-2">Peminjam</th>
                <th class="p-2">Kondisi</th>
                <th class="p-2">Catatan</th>
                <th class="p-2">Keterangan</th>
            </tr>
        </thead>

        <tbody class="text-center">
            @foreach($histories as $history)
            <tr class="border-t">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $history->created_at }}</td>
                <td class="p-2">{{ $history->barangItem->kode_item ?? '-' }}</td>
                <td class="p-2 text-left">{{ $history->user->nama ?? '-' }}</td>
                <td class="p-2">
                    <span class="px-2 py-1 rounded bg-gray-100">
                        {{ $history->kondisi_awal ?? '-' }}
                    </span>

                    <span>→</span>

                    <span class="px-2 py-1 rounded bg-gray-100 font-semibold">
                        {{ $history->kondisi_akhir ?? '-' }}
                    </span>
                </td>
                <td class="p-2">
                    <span class="px-2 py-1 rounded">
                        {{ $history->detailPengembalian->catatan ?? '-' }}
                    </span>
                </td>
                <td class="p-2">{{ $history->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $histories->links() }}
    </div>

</div>
@endsection