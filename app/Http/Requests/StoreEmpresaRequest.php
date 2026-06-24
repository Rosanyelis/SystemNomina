<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rifRule = 'unique:empresas,rif';
        if ($this->route('empresa')) {
            $rifRule .= ','.$this->route('empresa');
        }

        return [
            'razon_social' => ['required', 'string', 'max:255'],
            'rif' => ['required', 'string', 'max:20', $rifRule],
            'telefono' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:150'],
            'direccion' => ['nullable', 'string'],
            'activo' => ['boolean'],
        ];
    }
}
