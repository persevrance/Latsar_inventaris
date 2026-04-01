@props([
'type' => 'button',
'variant' => 'primary',
'href' => null,
'label' => null,
'disabled' => false,
])

@php
$base = "inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-medium transition";

$variants = [
'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
'secondary' => 'bg-yellow-200 text-gray-700 hover:bg-yellow-300',
'danger' => 'bg-red-600 text-white hover:bg-red-700',
'success' => 'bg-green-600 text-white hover:bg-green-700',
'outline' => 'bg-transparent border border-gray-300 text-gray-700 hover:bg-gray-100',
];

// fallback biar aman
$variantClass = $variants[$variant] ?? $variants['primary'];

// disabled state
$disabledClass = $disabled ? 'opacity-50 cursor-not-allowed' : '';

$classes = "$base $variantClass $disabledClass";
@endphp

@if ($href)
<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => $classes]) }}>
    {{ $label ?? $slot }}
</a>
@else
<button
    type="{{ $type }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => $classes]) }}>
    {{ $label ?? $slot }}
</button>
@endif