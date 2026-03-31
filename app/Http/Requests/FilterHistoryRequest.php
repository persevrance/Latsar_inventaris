<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal_awal'  => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
            'barang_id'     => 'nullable|exists:barang,id',
            'status'        => 'nullable|in:tersedia,dipinjam,maintenance,nonaktif',
        ];
    }
}
