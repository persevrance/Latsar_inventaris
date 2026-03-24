@extends('layouts.pegawai')

@section('content')
<h1 class="text-xl font-bold mb-4">Riwayat Peminjaman</h1>

@foreach($data as $row)
<div class="bg-white p-3 mb-2 shadow rounded">
    Status: {{ $row->status }}
</div>
@endforeach
@endsection