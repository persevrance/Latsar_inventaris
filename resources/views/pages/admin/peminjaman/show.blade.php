@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<h1 class="text-xl font-bold mb-4">Detail Peminjaman</h1>

<div class="bg-white p-6 rounded shadow mb-4">
    <p><strong>Peminjam:</strong> {{ $peminjaman->user->nama }}</p>
    <p><strong>Status:</strong> <x-inventory.status-badge :status="$peminjaman->status" /></p>
    <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>
</div>

<h2 class="font-semibold mb-2">Detail Barang</h2>

@foreach($peminjaman->details as $d)

<div class="grid grid-cols-1 md:grid-cols-2 md:justify-between bg-white shadow rounded p-6 mb-4">
    <div>
        <div class="font-bold">
            {{ $d->barangItem->barang->nama_barang ?? '-' }}
        </div>
        <div class="text-sm mb-2">
            {{ $d->barangItem->kode_item ?? '-' }}
        </div>
        <div class="text-sm">
            <span class="font-bold">Kondisi Awal:</span> {{ ucfirst($d->barangItem->kondisi) }}
        </div>
        <div class="text-sm mb-2">
            <span class="font-bold">Keterangan:</span> {{ $peminjaman->keterangan ?? '-' }}
        </div>

        @if ($peminjaman->status === 'completed' && $peminjaman->pengembalian)

        {{-- Detail Pengembalian --}}
        @php
        $detailReturn = $peminjaman->pengembalian->details
        ->firstWhere('barang_item_id', $d->barang_item_id);
        @endphp

        <div class="text-sm">
            <span class="font-bold">Tanggal Kembali:</span>
            {{ $peminjaman->pengembalian->tanggal_kembali }}
        </div>

        <div class="text-sm">
            <span class="font-bold">Kondisi Saat Dikembalikan:</span>
            {{ ucfirst($detailReturn->kondisi_kembali ?? '-') }}
        </div>

        <div class="text-sm">
            <span class="font-bold">Catatan:</span>
            {{ $detailReturn->catatan ?? '-' }}
        </div>

        @endif
    </div>
    <div class="flex justify-end items-start">
        <x-inventory.status-badge :status="$d->barangItem->status" />
    </div>
</div>

@endforeach

{{-- ACTION --}}
@if($peminjaman->status === 'pending')
<div class="flex gap-4">

    {{-- APPROVE --}}
    <form method="POST" action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}">
        @csrf
        @method('PATCH')
        <x-ui.button type="submit" variant="success">
            Approve
        </x-ui.button>
    </form>

    {{-- REJECT --}}
    <form method="POST" action="{{ route('admin.peminjaman.reject', $peminjaman->id) }}">
        @csrf
        @method('PATCH')
        <x-ui.button type="submit" variant="danger">
            Reject
        </x-ui.button>
    </form>

</div>
@endif

{{-- PROSES PENGEMBALIAN --}}
@if($peminjaman->status === 'active')
<div class="mt-4">
    <x-ui.button type="button" variant="primary" onclick="openModal()">
        Dikembalikan
    </x-ui.button>
</div>

{{-- MODAL --}}
<div id="modalReturn" class="fixed inset-0 bg-black/50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded shadow w-full max-w-lg">
        <h2 class="text-lg font-bold mb-4">Proses Pengembalian</h2>

        <form method="POST" action="{{ route('admin.pengembalian.process', $peminjaman->id) }}">
            @csrf

            @foreach($peminjaman->details as $d)
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">
                    {{ $d->barangItem->kode_item }}
                </label>

                <select name="items[{{ $d->barang_item_id }}]" class="w-full border p-2 rounded">
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>
            <div class="mb-3">
                <x-ui.form-input
                    label="Catatan (opsional)"
                    name="catatan[{{ $d->barang_item_id }}]"
                    type="textarea" />
            </div>
            @endforeach

            <div class="flex justify-end gap-2 mt-4">
                <x-ui.button type="button" variant="danger" onclick="closeModal()">
                    Batal
                </x-ui.button>

                <x-ui.button type="submit" variant="primary">
                    Simpan
                </x-ui.button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
    function openModal() {
        document.getElementById('modalReturn').classList.remove('hidden');
        document.getElementById('modalReturn').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modalReturn').classList.add('hidden');
        document.getElementById('modalReturn').classList.remove('flex');
    }
</script>
@endsection