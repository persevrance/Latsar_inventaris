@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<h1 class="text-xl font-bold mb-4">Detail Peminjaman</h1>

<div class="bg-white p-6 rounded shadow mb-4">
    <p><strong>Status:</strong> {{ $data->status }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $data->tanggal_pinjam }}</p>
    <p><strong>Tanggal Kembali:</strong> {{ $data->tanggal_kembali ?? '-' }}</p>
</div>

<h2 class="font-semibold mb-2">Barang Dipinjam</h2>

@foreach($data->details as $d)
<div class="bg-gray-50 p-3 rounded mb-2 flex justify-between">
    <div>
        {{ $d->barangItem->barang->nama_barang }}
        ({{ $d->barangItem->kode }})
    </div>

    <x-inventory.status-badge :status="$d->barangItem->status" />
</div>
@endforeach
@endsection