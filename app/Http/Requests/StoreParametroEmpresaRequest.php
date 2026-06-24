<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParametroEmpresaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'salario_minimo' => ['required', 'numeric', 'min:0'],
            'porcentaje_ivss' => ['required', 'numeric', 'min:0', 'max:100'],
            'porcentaje_faov' => ['required', 'numeric', 'min:0', 'max:100'],
            'porcentaje_rpe' => ['required', 'numeric', 'min:0', 'max:100'],
            'valor_ut' => ['required', 'numeric', 'min:0'],
            'vigencia_desde' => ['required', 'date'],
            'vigencia_hasta' => ['nullable', 'date', 'after:vigencia_desde'],
        ];
    }
}
