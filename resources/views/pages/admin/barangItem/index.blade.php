@extends('layouts.app')

@section('title', 'Barang Item')

@section('content')

<h1 class="text-xl font-bold mb-4">
    Item - {{ $barang->nama_barang }}
</h1>

<x-ui.button
    label="Tambah Item"
    onclick="openCreateModal()"
    variant="primary" />

<div class="mt-4 bg-white shadow rounded-xl p-4">

    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th>No</th>
                <th>Kode Item</th>
                <th>Status</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)
            <tr class="border-b">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_item }}</td>
                <td>
                    <x-inventory.status-badge :status="$item->status" />
                </td>
                <td>{{ ucfirst($item->kondisi) }}</td>
                <td class="flex gap-2 py-2">

                    <x-ui.button
                        label="Edit"
                        variant="secondary"
                        onclick="openEditModal(this)"
                        data-id="{{ $item->id }}"
                        data-status="{{ $item->status }}"
                        data-kode="{{ $item->kode_item }}" />

                    <form method="POST" action="{{ route('admin.barang.items.destroy', [$barang->id, $item->id]) }}">
                        @csrf
                        @method('DELETE')

                        <x-ui.button
                            label="Hapus"
                            variant="danger"
                            type="submit" />
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- Modal Create -->
<div id="modalCreate" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-96">

        <h2 class="font-bold mb-4">Tambah Item</h2>

        <form method="POST" action="{{ route('admin.barang.items.store', $barang->id) }}">
            @csrf

            <div class="mb-3 text-sm text-gray-500">
                Kode item akan dibuat otomatis
            </div>

            <select name="kondisi" class="w-full border p-2 mb-3">
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>

            <div class="flex justify-end gap-2">
                <x-ui.button type="button"
                    label="Batal"
                    variant="outline"
                    onclick="closeModal('modalCreate')" />
                <x-ui.button
                    type="submit"
                    label="Simpan"
                    variant="primary" />
            </div>

        </form>

    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-96">

        <h2 class="font-bold mb-4">Edit Item</h2>

        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')

            <select id="edit_kondisi" name="kondisi" class="w-full border p-2 mb-3">
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>

            <div class="flex justify-end gap-2">
                <x-ui.button type="button"
                    label="Batal"
                    variant="outline"
                    onclick="closeModal('modalEdit')" />
                <x-ui.button
                    type="submit"
                    label="Update"
                    variant="primary" />
            </div>

        </form>

    </div>
</div>


<!-- Scripts -->
<script>
    function openCreateModal() {
        document.getElementById('modalCreate').classList.remove('hidden');
    }

    function openEditModal(el) {
        const id = el.dataset.id;
        const kondisi = el.dataset.kondisi;

        document.getElementById('edit_kondisi').value = kondisi;

        const form = document.getElementById('formEdit');
        form.action = `/admin/barang/{{ $barang->id }}/items/${id}`;

        document.getElementById('modalEdit').classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endsection