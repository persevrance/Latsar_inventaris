@extends('layouts.app')

@section('content')
<div class="px-4 md:px-24 py-6 space-y-6">
    <h1 class="text-xl font-bold mb-4">Data Barang</h1>

    <a href="{{ route('barang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
        Tambah
    </a>

    <table class="w-full mt-4 bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th class="p-2">Nama Barang</th>
                <th class="p-2">Jumlah Item</th>
                <th class="p-2">Lokasi Penyimpanan</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr class="cursor-pointer hover:bg-gray-50 text-center">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $row->nama_barang }}</td>
                <td class="p-2 text-center">
                    <span class="bg-gray-200 px-2 py-1 rounded text-sm">
                        {{ $row->items_count }}
                    </span>
                </td>
                <td class="p-2">
                    {{ $row->lokasi->nama_lokasi ?? 'Tidak ada lokasi' }}
                </td>
                <td class="p-2 flex flex-row items-center space-x-2 justify-center">
                    {{-- DETAIL --}}
                    <div type="button" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition">
                        <a href="{{ route('barang.show', $row->id) }}">
                            Detail
                        </a>
                    </div>
                    {{-- ARSIP --}}
                    <form method="POST"
                        action="{{ route('barang.destroy', $row->id) }}"
                        onsubmit="return confirmArsip()">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600 transition">
                            Arsipkan
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmArsip() {
        return confirm('Arsipkan barang ini? Data tidak akan dihapus permanen.');
    }
</script>
</script>
@endsection