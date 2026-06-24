<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$this->route('usuario')?->getKey()],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'activo' => ['boolean'],
            'role' => ['required', 'exists:roles,name'],
        ];
    }
}
