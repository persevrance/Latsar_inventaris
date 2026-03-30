<?php

use Carbon\Carbon;

if (!function_exists('formatTanggal')) {
    function formatTanggal($date)
    {
        if (!$date || $date === '-') {
            return '-';
        }

        try {
            return Carbon::parse($date)->translatedFormat('d M Y');
        } catch (\Exception $e) {
            return '-';
        }
    }
}

if (!function_exists('formatDatetime')) {
    function formatDatetime($date)
    {
        if (!$date || $date === '-') {
            return '-';
        }

        try {
            return Carbon::parse($date)->translatedFormat('d M Y H:i');
        } catch (\Exception $e) {
            return '-';
        }
    }
}
