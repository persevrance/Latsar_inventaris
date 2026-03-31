@extends('layouts.app')

@section('title', 'Approval')

@section('content')
<h1 class="text-xl font-bold mb-4">Approval Peminjaman</h1>

<form method="POST" action="{{ route('admin.peminjaman.approve', $data->id) }}">
    @csrf

    <x-ui.button type="submit" variant="success">Approve</x-ui.button>
</form>
@endsection