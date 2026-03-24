@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">History Barang</h1>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Item</th>
            <th class="p-2">Aktivitas</th>
            <th class="p-2">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr class="border-t">
            <td class="p-2">{{ $row->barangItem->kode_item }}</td>
            <td class="p-2">{{ $row->aktivitas }}</td>
            <td class="p-2">{{ formatTanggal($row->tanggal) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection