@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <h1 class="text-xl font-bold mb-4">Laporan Peminjaman</h1>

    <form method="GET" class="mb-4 flex gap-2">
        <input type="date" name="tanggal_awal" class="border p-2">
        <input type="date" name="tanggal_akhir" class="border p-2">
        <button class="bg-blue-500 text-white px-4">Filter</button>
    </form>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th>User</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Kode Barang</th>
                <th>Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->user->nama }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    @foreach($item->details as $d)
                    {{ $d->barangItem->barang->kode_barang ?? '-' }} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($item->details as $d)
                    {{ $d->barangItem->barang->nama_barang ?? '-' }} <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection