@props(['barang'])

<div class="bg-white rounded-xl shadow p-4">
    <h3 class="font-semibold text-lg mb-2">
        {{ $barang->nama_barang }}
    </h3>

    <p class="text-sm text-gray-500 mb-2">
        Kategori: {{ $barang->kategori->nama ?? '-' }}
    </p>

    <div class="flex gap-2 flex-wrap">
        @foreach($barang->items as $item)
        <x-inventory.status-badge :status="$item->status" />
        @endforeach
    </div>
</div>