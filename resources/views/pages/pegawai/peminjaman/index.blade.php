@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<h1 class="text-xl font-bold mb-4">Riwayat</h1>

@foreach($data as $p)
<div class="bg-white p-4 rounded shadow mb-3">
    Status: {{ $p->status }}
</div>
@endforeach
@endsection