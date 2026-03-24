@extends('layouts.app')
@section('content')
<h1 class="text-xl">Riwayat</h1>

@foreach($data as $row)
<div class="bg-white p-3 mb-2 shadow">
    Status: {{ $row->status }}
</div>
@endforeach
@endsection