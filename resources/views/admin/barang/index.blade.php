@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Data Barang</h1>

<a href="{{ route('barang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
    Tambah
</a>

<table class="w-full mt-4 bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Kode</th>
            <th class="p-2">Nama</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr class="border-t">
            <td class="p-2">{{ $row->kode_barang }}</td>
            <td class="p-2">{{ $row->nama_barang }}</td>
            <td class="p-2">
                <a href="{{ route('barang.edit',$row->id) }}" class="text-blue-500">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection