@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <h1 class="text-xl font-bold">Tambah Barang Item</h1>

    <form method="POST" action="{{ route('barang-item.store') }}" class="space-y-4">
        @csrf

        {{-- KODE ITEM --}}
        <div>
            <label class="block mb-1 font-medium">Kode Item</label>
            <input name="kode_item"
                value="{{ old('kode_item') }}"
                class="border p-2 w-full rounded"
                placeholder="Auto generate, tidak perlu diisi" disabled>

            @error('kode_item')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- PILIH BARANG --}}
        <div>
            <label class="block mb-1 font-medium">Pilih Barang</label>
            <select name="barang_id" class="border p-2 w-full rounded" disabled>
                <option value="">-- Pilih Barang --</option>

                @forelse($barang as $b)
                <option value="{{ $b->id }}"
                    {{ old('barang_id', request('barang_id')) == $b->id ? 'selected' : '' }}>
                    {{ $b->nama_barang }}
                </option>
                @empty
                <option disabled>Data barang kosong</option>
                @endforelse
            </select>

            @error('barang_id')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- RAK --}}
        <div>
            <label class="block mb-1 font-medium">Rak / Posisi</label>
            <input name="rak"
                value="{{ old('rak') }}"
                class="border p-2 w-full rounded"
                placeholder="Contoh: A1, Rak 2, Lemari 3">

            @error('rak')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- INFO --}}
        <div class="bg-gray-100 p-3 rounded text-sm">
            Item akan otomatis mengikuti lokasi penyimpanan dari barang.
        </div>

        {{-- BUTTON --}}
        <div class="flex gap-2">
            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Simpan
            </button>

            <a href="{{ route('barang.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection