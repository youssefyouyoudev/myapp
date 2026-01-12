<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'sometimes|string|max:255',
            'cin' => 'sometimes|string|max:50|unique:clients,cin,' . $this->route('client')->id,
            'date_of_birth' => 'sometimes|date',
            'school' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:active,suspended',
        ];
    }
}
