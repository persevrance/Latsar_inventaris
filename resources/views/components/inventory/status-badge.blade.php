@props(['status'])

@php
$colors = [
'tersedia' => 'bg-green-100 text-green-700',
'dipinjam' => 'bg-yellow-100 text-yellow-700',
'maintenance' => 'bg-blue-100 text-blue-700',
'nonaktif' => 'bg-red-100 text-red-700',

'pending' => 'bg-gray-100 text-gray-700',
'approved' => 'bg-green-100 text-green-700',
'rejected' => 'bg-red-100 text-red-700',
'active' => 'bg-yellow-100 text-yellow-700',
'completed' => 'bg-blue-100 text-blue-700'
];
@endphp

<span class="px-2 py-1 text-xs rounded {{ $colors[$status] ?? 'bg-gray-100' }}">
    {{ ucfirst($status) }}
</span>