<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengembalianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'peminjaman_id' => 'required|exists:peminjaman,id',

            'items' => 'required|array|min:1',

            'items.*' => 'required|in:baik,rusak,hilang',
        ];
    }

    public function attributes(): array
    {
        return [
            'items.*' => 'kondisi barang',
        ];
    }
}
