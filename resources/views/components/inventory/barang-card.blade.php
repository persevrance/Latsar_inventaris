@props(['barang'])

<div class="bg-white rounded-xl shadow p-4">
    <h3 class="font-semibold text-lg">
        {{ $barang->nama_barang }}
    </h3>
    <p class="text-sm text-gray-500 mb-4">
        {{ $barang->kode_barang }}
    </p>

    <p class="text-sm text-gray-500 mb-2">
        Kategori: {{ $barang->kategori->nama_kategori ?? '-' }}
    </p>

    <p class="text-sm text-gray-500 mb-2">
        Lokasi Barang: {{ $barang->lokasi->nama_lokasi ?? '-' }}
    </p>

    <div class="flex gap-2 flex-wrap">
        @foreach($barang->items as $item)
        <x-inventory.status-badge :status="$item->status" />
        @endforeach
    </div>

    <div class="flex flex-row gap-2 my-2 py-2">
        <div class="flex gap-2 flex-wrap">
            <x-ui.button href="{{ route('admin.barang.items.index', $barang->id) }}" variant="primary" label="Detail Item" />
        </div>

        <div class="flex gap-2 flex-wrap">
            <x-ui.button
                o onclick="openModalFromElement(this)"
                data-id="{{ $barang->id }}"
                data-nama="{{ $barang->nama_barang }}"
                data-kategori="{{ $barang->kategori_id }}"
                data-lokasi="{{ $barang->lokasi_id }}"
                data-kode="{{ $barang->kode_barang }}"
                variant="secondary"
                label="Update" />
        </div>

        <div class="flex gap-2 flex-wrap">
            <form method="POST" action="{{ route('admin.barang.destroy', $barang->id) }}">
                @csrf
                @method('DELETE')

                <x-ui.button
                    type="submit"
                    variant="danger"
                    label="Hapus"
                    onclick="return confirm('Yakin Hapus?')" />
            </form>
        </div>
    </div>

</div>