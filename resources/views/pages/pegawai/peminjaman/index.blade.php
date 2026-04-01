@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="flex flex-row justify-between p-4 m-2">
    <h1 class="text-xl font-bold">Riwayat Peminjaman</h1>

    <x-ui.button href="{{ route('pegawai.peminjaman.create') }}"
        variant="primary"
        label="Ajukan Peminjaman" />
</div>

@foreach($data as $p)
<div class="bg-white p-4 rounded shadow mb-3">

    @foreach($p->details as $d)
    <div class="font-bold">
        {{ $d->barangItem->barang->nama_barang ?? '-' }}
    </div>

    <div class="text-sm mb-2">
        {{ $d->barangItem->kode_item ?? '-' }}
    </div>

    <div class="mb-4">
        <span></span>
    </div>
    @endforeach

    <x-inventory.status-badge :status="$p->status" />
</div>
@endforeach
@endsection