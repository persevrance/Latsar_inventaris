@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<h1 class="text-xl font-bold mb-4">Ajukan Peminjaman</h1>

<form method="POST">
    @csrf

    <div class="mb-4">
        <label>Barang</label>
        <select name="barang_item_id[]" multiple data-tomselect>
            @foreach($items as $i)
            <option value="{{ $i->id }}">{{ $i->kode }}</option>
            @endforeach
        </select>
    </div>

    <x-ui.button type="submit">Ajukan</x-ui.button>
</form>
@endsection