<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
{
    public function rules()
    {
        return [
            'barang_item_id' => 'required|array|min:1',
            'barang_item_id.*' => 'exists:barang_item,id',
        ];
    }

    public function messages()
    {
        return [
            'barang_item_id.required' => 'Pilih minimal 1 barang',
        ];
    }
}
