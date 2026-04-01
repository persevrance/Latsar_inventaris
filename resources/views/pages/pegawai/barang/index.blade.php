@extends('layouts.app')

@section('content')
<div class="p-6" x-data="barangPage()">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Barang</h1>
        <p class="text-sm text-gray-500">Lihat ketersediaan barang inventaris</p>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Nama Barang</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Lokasi</th>
                    <th class="px-6 py-3">Jumlah</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($barang as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $item->nama_barang }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->kategori->nama_kategori ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->lokasi->nama_lokasi ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->items->count() }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        <button
                            @click="openModal({{ $item->id }}, '{{ $item->nama }}')"
                            class="px-3 py-1.5 text-xs bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Detail
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-400">
                        Tidak ada data barang
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- MODAL --}}
    <div x-show="showModal"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

        <div @click.outside="closeModal"
            class="bg-white w-full max-w-2xl rounded-xl shadow-lg p-6">

            {{-- HEADER --}}
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800">
                    Detail Item: <span x-text="selectedNama"></span>
                </h2>

                <button @click="closeModal"
                    class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>

            {{-- LOADING --}}
            <div x-show="loading" class="text-center py-6 text-gray-400">
                Loading...
            </div>

            {{-- ITEMS TABLE --}}
            <div x-show="!loading">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-xs text-gray-600 uppercase">
                        <tr>
                            <th class="px-4 py-2">Kode</th>
                            <th class="px-4 py-2">Kondisi</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        <template x-for="item in items" :key="item.id">
                            <tr>
                                <td class="px-4 py-2" x-text="item.kode_item"></td>
                                <td class="px-4 py-2 capitalize" x-text="item.kondisi"></td>
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full"
                                        :class="statusClass(item.status)"
                                        x-text="item.status">
                                    </span>
                                </td>
                            </tr>
                        </template>

                        <tr x-show="items.length === 0">
                            <td colspan="3" class="text-center py-4 text-gray-400">
                                Tidak ada item
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

{{-- SCRIPT --}}
<script>
    function barangPage() {
        return {
            showModal: false,
            loading: false,
            items: [],
            selectedNama: '',

            async openModal(id, nama) {
                this.showModal = true;
                this.loading = true;
                this.items = [];
                this.selectedNama = nama;

                try {
                    const res = await fetch(`/pegawai/barang/${id}/items`);
                    const data = await res.json();
                    this.items = data;
                } catch (e) {
                    console.error(e);
                } finally {
                    this.loading = false;
                }
            },

            closeModal() {
                this.showModal = false;
                this.items = [];
            },

            statusClass(status) {
                return {
                    'bg-green-100 text-green-700': status === 'tersedia',
                    'bg-yellow-100 text-yellow-700': status === 'dipinjam',
                    'bg-red-100 text-red-700': status === 'rusak',
                };
            }
        }
    }
</script>
@endsection