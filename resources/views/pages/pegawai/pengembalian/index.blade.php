@extends('layouts.app')

@section('title', 'Pengembalian')

@section('content')
<h1 class="text-xl font-bold">Pengembalian</h1>

@foreach($data as $p)
<div class="bg-white p-4 rounded shadow mb-3">
    {{ $p->peminjaman->id }}
</div>
@endforeach
@endsection