@extends('layouts.app')

@section('title', 'Master Lokasi')

@section('content')
<div x-data="{ openModal: false, editMode: false, form: { id: null, nama_lokasi: '' } }">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Master Lokasi</h1>

        <button @click="openModal = true; editMode = false; form = { id: null, nama_lokasi: '' }"
            class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah
        </button>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">No</th>
                    <th class="p-2 text-left">Nama Lokasi</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lokasi as $item)
                <tr class="border-t">
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $item->nama_lokasi }}</td>
                    <td class="p-2 flex gap-2">
                        <button
                            @click="openModal = true; editMode = true; form = { id: {{ $item->id }}, nama_lokasi: '{{ $item->nama_lokasi }}' }"
                            class="bg-yellow-400 px-3 py-1 rounded text-sm">
                            Edit
                        </button>

                        <form action="{{ route('admin.lokasi.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-3 text-center text-gray-500">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div x-show="openModal"
        class="fixed inset-0 bg-opacity-70 backdrop-blur-sm flex items-center justify-center"
        x-transition>

        <div class="bg-white p-6 rounded w-96">
            <h2 class="text-lg font-bold mb-4"
                x-text="editMode ? 'Edit Lokasi' : 'Tambah Lokasi'"></h2>

            <form
                :action="editMode
                    ? `/lokasi/${form.id}`
                    : `{{ route('admin.lokasi.store') }}`"
                method="POST">

                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="mb-3">
                    <label class="block text-sm mb-1">Nama Lokasi</label>
                    <input type="text" name="nama_lokasi"
                        x-model="form.nama_lokasi"
                        class="w-full border p-2 rounded" required>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button"
                        @click="openModal = false"
                        class="px-3 py-1 border rounded">
                        Batal
                    </button>

                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-1 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection