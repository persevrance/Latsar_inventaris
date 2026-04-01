@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-xl font-bold">Dashboard Pegawai</h1>

<p class="mt-2 text-gray-600">
    Selamat datang, {{ auth()->user()->nama }}
</p>
@endsection