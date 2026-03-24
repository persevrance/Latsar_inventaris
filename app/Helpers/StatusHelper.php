<?php

use Carbon\Carbon;

if (!function_exists('formatTanggal')) {
    function formatTanggal($date)
    {
        return Carbon::parse($date)->translatedFormat('d M Y');
    }
}

if (!function_exists('formatDatetime')) {
    function formatDatetime($date)
    {
        return Carbon::parse($date)->translatedFormat('d M Y H:i');
    }
}
