@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
<h1 class="text-xl font-bold mb-4">Data Peminjaman</h1>

<x-ui.table>
    <x-slot name="head">
        <th class="p-2">User</th>
        <th>Status</th>
        <th>Aksi</th>
    </x-slot>

    <x-slot name="body">
        @foreach($data as $p)
        <tr class="border-t">
            <td class="p-2">{{ $p->user->name }}</td>
            <td>{{ $p->status }}</td>
            <td>
                <a href="{{ route('admin.peminjaman.show', $p->id) }}">
                    <x-ui.button variant="secondary">Detail</x-ui.button>
                </a>
            </td>
        </tr>
        @endforeach
    </x-slot>
</x-ui.table>
@endsection