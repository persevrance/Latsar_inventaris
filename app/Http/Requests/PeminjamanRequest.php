<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items'   => 'required|array|min:1',
            'items.*' => 'exists:barang_item,id',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Minimal 1 barang harus dipilih',
        ];
    }
}
