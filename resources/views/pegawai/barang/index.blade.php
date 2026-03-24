@extends('layouts.pegawai')

@section('content')
<h1 class="text-xl mb-4">Barang</h1>

@foreach($data as $row)
<div class="bg-white p-3 mb-2 shadow">
    {{ $row->nama_barang }}
</div>
@endforeach
@endsection