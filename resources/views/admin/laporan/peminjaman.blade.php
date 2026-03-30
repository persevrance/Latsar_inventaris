@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <div class="flex flex-row gap-4 p-2 justify-between">
        <h1 class="text-xl font-bold mb-4">Laporan Peminjaman</h1>
        <a href="{{ route('admin.laporan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>


    <form method="GET" class="mb-4 flex gap-2">
        <input type="date" name="tanggal_awal" class="border p-2">
        <input type="date" name="tanggal_akhir" class="border p-2">
        <button class="bg-blue-500 text-white px-4">Filter</button>
    </form>

    <table class="w-full border rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th class="p-2">Nama Peminjam</th>
                <th class="p-2">Tanggal Pinjam</th>
                <th class="p-2">Kode Barang</th>
                <th class="p-2">Nama Barang</th>
                <th class="p-2">Kode Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class="text-center">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2 text-left">{{ $item->user->nama }}</td>
                <td class="p-2">{{ formatTanggal($item->tanggal_pinjam) }}</td>
                <td class="p-2">
                    @foreach($item->details as $d)
                    {{ $d->barangItem->barang->kode_barang ?? '-' }} <br>
                    @endforeach
                </td>
                <td class="p-2 text-left">
                    @foreach($item->details as $d)
                    {{ $d->barangItem->barang->nama_barang ?? '-' }} <br>
                    @endforeach
                </td>
                <td class="p-2">
                    @foreach($item->details as $d)
                    {{ $d->barangItem->kode_item ?? '-' }} <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection