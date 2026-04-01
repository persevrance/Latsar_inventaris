@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-xl font-bold">Data Barang</h1>

    <a href="{{ route('admin.barang.create') }}">
        <x-ui.button>Tambah Barang</x-ui.button>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($barang as $b)
    <x-inventory.barang-card :barang="$b" />
    @endforeach
</div>

<!-- modal update -->
<div id="modalUpdate" class="fixed inset-0 bg-black/50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded w-96">

        <h2 class="text-lg font-bold mb-4">Update Barang</h2>

        <form id="formUpdate" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Kode Barang</label>
                <input
                    type="text"
                    value=""
                    id="kode_barang_display"
                    class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                    readonly>
            </div>
            <input type="hidden" id="barang_id">

            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori_id" id="kategori_id" class="w-full border p-2 rounded">
                    @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Lokasi</label>
                <select name="lokasi_id" id="lokasi_id" class="w-full border p-2 rounded">
                    @foreach($lokasi as $l)
                    <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <x-ui.button type="button" label="Batal" variant="outline" onclick="closeModal()" />

                <x-ui.button type="submit" label="Simpan" variant="primary" />
            </div>
        </form>
    </div>
</div>

<script>
    function openModalFromElement(el) {
        openModal(
            el.dataset.id,
            el.dataset.nama,
            el.dataset.kategori,
            el.dataset.lokasi,
            el.dataset.kode
        );
    }

    function openModal(id, nama, kategori, lokasi, kode) {
        const modal = document.getElementById('modalUpdate');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // isi form
        document.getElementById('nama_barang').value = nama;
        document.getElementById('kategori_id').value = kategori;
        document.getElementById('lokasi_id').value = lokasi;

        // kode barang (readonly display)
        document.getElementById('kode_barang_display').value = kode;

        // set action
        document.getElementById('formUpdate').action = `/admin/barang/${id}`;
    }

    function closeModal() {
        const modal = document.getElementById('modalUpdate');
        modal.classList.add('hidden');
    }
</script>
@endsection