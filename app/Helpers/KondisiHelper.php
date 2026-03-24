<?php

if (!function_exists('kondisiBadge')) {
    function kondisiBadge($kondisi)
    {
        return match ($kondisi) {
            'baik' => 'bg-green-500',
            'rusak' => 'bg-yellow-500',
            'hilang' => 'bg-red-600',
            default => 'bg-gray-400'
        };
    }
}
