<?php

use Illuminate\Foundation\Http\FormRequest;

class PengembalianRequest extends FormRequest
{
    public function rules()
    {
        return [
            'items' => 'required|array',
            'items.*.barang_item_id' => 'required|exists:barang_item,id',
            'items.*.kondisi_kembali' => 'required|in:baik,rusak,hilang',
        ];
    }
}
