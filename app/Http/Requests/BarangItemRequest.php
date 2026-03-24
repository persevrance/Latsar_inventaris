<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'barang_id' => 'required|exists:barang,id',
            'kode_item' => 'required|string|max:100|unique:barang_item,kode_item',
            'lokasi_id' => 'required|exists:lokasi,id',
            'rak' => 'nullable|string|max:50',
        ];
    }
}
