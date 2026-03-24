@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">

    <h1 class="text-xl font-bold">Tambah Barang</h1>

    <form method="POST" action="{{ route('barang.store') }}" class="space-y-4">
        @csrf

        {{-- NAMA BARANG --}}
        <div>
            <label class="block mb-1 font-medium">Nama Barang</label>
            <input name="nama_barang"
                value="{{ old('nama_barang') }}"
                class="border p-2 w-full rounded"
                placeholder="Contoh: Router Mikrotik">

            @error('nama_barang')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- KODE BARANG --}}
        <div>
            <label class="block mb-1 font-medium">Kode Barang</label>
            <input name="kode_barang"
                value="{{ old('kode_barang') }}"
                class="border p-2 w-full rounded"
                placeholder="Auto generate, tidak perlu diisi" disabled>

            @error('kode_barang')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- KATEGORI --}}
        <div>
            <label class="block mb-1 font-medium">Kategori</label>
            <select name="kategori_id" class="border p-2 w-full rounded">
                <option value="">-- Pilih Kategori --</option>

                @foreach($kategori as $k)
                <option value="{{ $k->id }}"
                    {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
                @endforeach
            </select>

            @error('kategori_id')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- LOKASI PENYIMPANAN --}}
        <div>
            <label class="block mb-1 font-medium">Lokasi Penyimpanan</label>
            <select name="lokasi_id" class="border p-2 w-full rounded">
                <option value="">-- Pilih Lokasi --</option>

                @foreach($lokasi as $l)
                <option value="{{ $l->id }}"
                    {{ old('lokasi_id') == $l->id ? 'selected' : '' }}>
                    {{ $l->nama_lokasi }}
                </option>
                @endforeach
            </select>

            @error('lokasi_id')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- BUTTON --}}
        <div class="flex gap-2">
            <button class="bg-blue-500 text-white px-4 py-2 rounded">
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