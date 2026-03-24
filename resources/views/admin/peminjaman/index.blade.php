@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Verifikasi Peminjaman</h1>

@foreach($data->details as $item)
<div class="bg-white p-3 mb-2 shadow rounded">
    {{ $item->barangItem->kode_item }}
</div>
@endforeach

<form method="POST" action="/admin/peminjaman/{{ $data->id }}/proses">
    @csrf
    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Proses
    </button>
</form>
@endsection