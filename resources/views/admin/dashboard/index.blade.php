@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-4 gap-4">
    <div class="bg-white p-4 rounded shadow">
        <p>Total Barang</p>
        <h2 class="text-xl font-bold">{{ $total_barang }}</h2>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p>Dipinjam</p>
        <h2 class="text-xl font-bold">{{ $dipinjam }}</h2>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p>Maintenance</p>
        <h2 class="text-xl font-bold">{{ $maintenance }}</h2>
    </div>
</div>
@endsection