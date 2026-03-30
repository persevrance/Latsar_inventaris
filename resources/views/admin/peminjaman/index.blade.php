@extends('layouts.app')

@section('content')

<div class="px-4 md:px-24 py-6 space-y-6">
    <h1 class="text-xl font-bold mb-4">Data Peminjaman</h1>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">ID Pinjam</th>
                    <th class="p-3 text-left">Nama Peminjam</th>
                    <th class="p-3 text-left">Tanggal Pengajuan</th>
                    <th class="p-3 text-left">Tanggal Pinjam</th>
                    <th class="p-3 text-left">Estimasi Tanggal Kembali</th>
                    <th class="p-3 text-left">Tanggal Kembali</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $item->id }}</td>

                    <td class="p-3">
                        {{ $item->user->nama ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ formatTanggal($item->tanggal_pengajuan) }}
                    </td>

                    <td class="p-3">
                        {{ formatTanggal($item->tanggal_pinjam) }}
                    </td>

                    <td class="p-3">
                        {{ formatTanggal($item->tanggal_kembali_rencana) }}
                    </td>

                    <td class="p-3">
                        {{ formatTanggal($item->pengembalian?->tanggal_kembali) ?? '-' }}
                    </td>

                    <td class="p-3">
                        @switch($item->status)

                        @case('pending')
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">
                            Pending
                        </span>
                        @break

                        @case('approved')
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                            Approved
                        </span>
                        @break

                        @case('rejected')
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">
                            Rejected
                        </span>
                        @break

                        @case('completed')
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">
                            Completed
                        </span>
                        @break

                        @case('active')
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">
                            Active
                        </span>
                        @break

                        @default
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs">
                            Unknown
                        </span>

                        @endswitch
                    </td>

                    <td class="p-3 text-center">
                        @if($item->status == 'pending')
                        <a href="/admin/peminjaman/{{ $item->id }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                            Verifikasi
                        </a>

                        @elseif($item->status == 'approved')
                        <button
                            onclick='openModal(
        {{ $item->id }},
        @json($item->details->map(function($d){
            return $d->barangItem->kode_item . " - " . ($d->barangItem->barang->nama_barang ?? "-");
        }))
    )'
                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                            Dikembalikan
                        </button>

                        @elseif($item->status == 'completed')
                        <a href="/admin/pengembalian/{{ $item->id }}/detail"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-xs">
                            Detail
                        </a>

                        @else
                        <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-500">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<!-- MODAL -->
<div id="modalPengembalian" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg p-6 rounded shadow-lg">

        <h2 class="text-lg font-bold mb-4">Form Pengembalian</h2>

        <form id="formPengembalian" method="POST">
            @csrf

            {{-- BARANG --}}
            <div class="mb-3">
                <label class="block text-sm mb-1">Barang</label>
                <input type="text" id="namaBarang"
                    class="w-full border p-2 rounded bg-gray-100"
                    readonly>
            </div>

            {{-- KONDISI --}}
            <div class="mb-3">
                <label class="block text-sm mb-1">Kondisi</label>
                <select name="kondisi" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih --</option>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>

            {{-- CATATAN --}}
            <div class="mb-3">
                <label class="block text-sm mb-1">Catatan</label>
                <textarea name="catatan" class="w-full border p-2 rounded"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="px-3 py-1 bg-gray-400 text-white rounded">
                    Batal
                </button>

                <button type="submit"
                    class="px-3 py-1 bg-green-500 text-white rounded">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>


<script>
    function openModal(id, items) {
        console.log("OPEN MODAL", id, items); // debug

        const modal = document.getElementById('modalPengembalian');
        const form = document.getElementById('formPengembalian');
        const inputBarang = document.getElementById('namaBarang');

        form.action = `/admin/pengembalian/${id}`;

        if (items && items.length > 0) {
            inputBarang.value = items.join(' | ');
        } else {
            inputBarang.value = '-';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('modalPengembalian');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection