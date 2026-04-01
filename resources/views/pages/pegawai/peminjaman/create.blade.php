@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<h1 class="text-xl font-bold mb-4">Ajukan Peminjaman</h1>

<form method="POST" action="{{ route('pegawai.peminjaman.store') }}">
    @csrf

    <div class="mb-4">
        <label>Barang</label>
        <select id="barangSelect" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barangs as $b)
            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>Item (Kode Barang)</label>
        <select
            id="itemSelect"
            name="item_id"
            class="w-full border p-2 rounded"
            required>
            <option value="">-- Pilih Item --</option>
        </select>
    </div>

    <div class="mb-4">
        <label>Tanggal Pinjam</label>
        <x-ui.form-input type="date" name="tanggal_pinjam" required />
    </div>

    <div class="mb-4">
        <label>Tanggal Kembali</label>
        <x-ui.form-input type="date" name="tanggal_kembali_rencana" required />
    </div>

    <div class="mb-4">
        <x-ui.form-input label="Keperluan" name="keterangan" />
    </div>

    <x-ui.button type="submit">Ajukan</x-ui.button>
</form>

<script>
    document.getElementById('barangSelect').addEventListener('change', function() {

        const barangId = this.value;
        const itemSelect = document.getElementById('itemSelect');

        // reset dropdown
        itemSelect.innerHTML = '<option value="">-- Pilih Item --</option>';

        if (!barangId) return;

        fetch(`/pegawai/barang/${barangId}/items`)
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.kode_item;
                    itemSelect.appendChild(option);
                });
            });
    });
</script>
@endsection