<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_barang' => 'required|string|max:150',
            'kategori_id' => 'nullable|exists:kategori,id',
            'lokasi_id' => 'nullable|exists:lokasi,id',
        ];
    }
}
