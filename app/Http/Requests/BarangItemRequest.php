<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barang_id' => 'required|exists:barang,id',
            'kode_item' => 'required|string|max:100|unique:barang_item,kode_item,' . $this->route('item'),
            'kondisi'   => 'nullable|in:baik,rusak,hilang',
        ];
    }
}
