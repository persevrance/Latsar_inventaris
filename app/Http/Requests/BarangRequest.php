<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // nanti bisa pakai policy
    }

    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'required|exists:lokasi,id',
        ];
    }
}
