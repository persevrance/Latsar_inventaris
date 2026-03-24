@extends('layouts.app')
@section('content')
<h1 class="text-xl mb-4">Pengembalian</h1>

@foreach($data as $row)
<form method="POST" action="/admin/pengembalian/{{ $row->id }}">
    @csrf

    <div class="bg-white p-3 mb-2 shadow rounded">
        {{ $row->id }}
        <button class="bg-green-500 text-white px-2 py-1">Proses</button>
    </div>

</form>
@endforeach
@endsection