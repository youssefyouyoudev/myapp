<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'cin' => 'required|string|max:50|unique:clients,cin',
            'date_of_birth' => 'required|date',
            'school' => 'required|string|max:255',
            'status' => 'nullable|in:active,suspended',
        ];
    }
}
