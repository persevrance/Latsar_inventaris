<?php

if (!function_exists('generateKodeItem')) {
    function generateKodeItem($prefix = 'BRG')
    {
        return $prefix . '-' . strtoupper(uniqid());
    }
}
