@extends('layouts.app')

@section('title', 'Proses Pengembalian')

@section('content')
<h1 class="text-xl font-bold mb-4">Pengembalian</h1>

<form method="POST">
    @csrf

    @foreach($details as $d)
    <div class="mb-3">
        <label>{{ $d->barangItem->kode }}</label>

        <select name="items[{{  $d->barang_item_id }}]" class="w-full border p-2 rounded">
            <option value="baik">Baik</option>
            <option value="rusak">Rusak</option>
            <option value="hilang">Hilang</option>
        </select>
    </div>
    @endforeach

    <x-ui.button type="submit">Proses</x-ui.button>
</form>
@endsection