@extends('layouts.app')

@section('content')
<div class="px-6 md:px-16 py-6 space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">History Peminjaman</h1>
            <p class="text-sm text-gray-500">Daftar pengajuan Anda</p>
        </div>

        <a href="{{ url('/pegawai/peminjaman/create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
            + Ajukan
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Barang</th>
                    <th class="px-4 py-3 text-left">Kode Item</th>
                    <th class="px-4 py-3 text-left">Keterangan</th>
                    <th class="px-4 py-3 text-left">Tanggal Pengajuan</th>
                    <th class="px-4 py-3 text-left">Tanggal Pinjam</th>
                    <th class="px-4 py-3 text-left">Estimasi Pengembalian</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $index => $row)
                <tr class="border-t">

                    <td class="px-4 py-3">{{ $loop->iteration }}</td>

                    <!-- Barang -->
                    <td class="px-4 py-3">
                        {{ $row->details->first()->barangItem->barang->nama_barang ?? '-' }}
                    </td>
                    <!-- Kode Item -->
                    <td class="px-4 py-3">
                        {{ $row->details->first()->barangItem->kode_item ?? '-' }}
                    </td>
                    <!-- Keterangan -->
                    <td class="px-4 py-3">
                        {{ $row->keterangan ?? '-' }}
                    </td>

                    <!-- Tanggal -->
                    <td class="px-4 py-3">
                        {{ formatTanggal($row->tanggal_pengajuan ?? '-') }}
                    </td>

                    <!-- Tanggal Pinjam -->
                    <td class="px-4 py-3">
                        {{ formatTanggal($row->tanggal_pinjam ?? '-') }}
                    </td>

                    <!-- Estimasi -->
                    <td class="px-4 py-3">
                        {{ formatTanggal($row->tanggal_kembali_rencana ?? '-') }}
                    </td>

                    <!-- Status -->
                    <td class="px-4 py-3">
                        @if($row->status == 'pending')
                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Pending</span>
                        @elseif($row->status == 'approved')
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">Approved</span>
                        @elseif($row->status == 'rejected')
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Rejected</span>
                        @elseif($row->status == 'returned')
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Returned</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Belum ada peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection