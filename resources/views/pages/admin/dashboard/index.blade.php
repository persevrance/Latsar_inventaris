@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h1 class="text-xl font-bold mb-6">Dashboard Admin</h1>

<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded shadow">
        Total Barang: {{ $totalBarang }}
    </div>

    <div class="bg-white p-4 rounded shadow">
        Dipinjam: {{ $dipinjam }}
    </div>

    <div class="bg-white p-4 rounded shadow">
        Tersedia: {{ $tersedia }}
    </div>
</div>
@endsection