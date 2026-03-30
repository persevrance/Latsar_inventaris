@extends('layouts.app')

@section('content')
<div class="px-6 md:px-16 py-6 space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold">Ajukan Peminjaman</h1>
        <p class="text-sm text-gray-500">Pilih barang dan isi detail peminjaman</p>
    </div>

    <form method="POST" action="{{ url('/pegawai/peminjaman') }}" class="space-y-6">
        @csrf

        <!-- VALIDATION ERROR -->
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- FORM INPUT -->
        <div class="grid md:grid-cols-3 gap-4">

            <div>
                <label class="text-sm">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" required
                    class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>

            <div>
                <label class="text-sm">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali_rencana" required
                    class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>

            <div>
                <label class="text-sm">Keterangan</label>
                <input type="text" name="keterangan"
                    class="w-full border rounded-lg px-3 py-2 text-sm"
                    placeholder="Opsional">
            </div>

        </div>

        <!-- GRID BARANG -->
        <div>
            <h2 class="font-semibold mb-2">Pilih Barang</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">

                @forelse($barang as $item)
                <label class="bg-white p-4 rounded-xl shadow cursor-pointer hover:shadow-lg transition border">

                    <div class="flex items-start gap-3">

                        <input type="checkbox"
                            name="barang_item_id[]"
                            value="{{ $item->id }}"
                            class="mt-1 checkbox-barang">

                        <div>
                            <h2 class="font-semibold text-sm">
                                {{ $item->nama_barang }}
                            </h2>

                            <p class="text-xs text-gray-500">
                                <span class="font-bold">Kode:</span> {{ $item->barang->kode_barang }} <br>
                                <span class="font-bold">Nama Barang:</span> {{ $item->barang->nama_barang }} <br>
                                <span class="font-bold">Kode Item:</span> {{ $item->kode_item }} <br>
                            </p>

                            <span class="inline-block mt-2 text-xs px-2 py-1 rounded bg-green-100 text-green-700">
                                Tersedia
                            </span>
                        </div>

                    </div>

                </label>
                @empty
                <div class="col-span-full text-center text-gray-500">
                    Tidak ada barang tersedia
                </div>
                @endforelse

            </div>
        </div>

        <!-- ACTION -->
        <div class="flex justify-between items-center">

            <span class="text-sm text-gray-500">
                Barang dipilih: <span id="totalSelected">0</span>
            </span>

            <button type="submit"
                id="submitBtn"
                disabled
                class="bg-blue-500 opacity-50 text-white px-6 py-2 rounded-lg cursor-not-allowed">
                Ajukan Peminjaman
            </button>
        </div>

    </form>

</div>

<!-- SCRIPT UX -->
<script>
    const checkboxes = document.querySelectorAll('.checkbox-barang');
    const totalSelected = document.getElementById('totalSelected');
    const submitBtn = document.getElementById('submitBtn');

    function updateSelection() {
        let count = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) count++;
        });

        totalSelected.innerText = count;

        if (count > 0) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateSelection));
</script>

@endsection