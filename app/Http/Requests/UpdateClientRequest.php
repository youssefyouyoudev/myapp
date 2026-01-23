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
                'cin' => 'sometimes|string|max:255|unique:etudiants,cin,' . $this->route('etudiant'),
                'date_of_birth' => 'sometimes|date',
                'school' => 'sometimes|string|max:255',
                'status' => 'sometimes|in:active,suspended',
            ];
    }
}
    class UpdateEtudiantRequest extends FormRequest
    {
        public function authorize()
        {
            return true;
        }

        public function rules()
        {
            return [
                'user_id' => 'sometimes|exists:users,id',
                'full_name' => 'sometimes|string|max:255',
                'phone' => 'sometimes|string|max:255',
                'status' => 'sometimes|in:active,suspended',
                'cin' => 'sometimes|string|max:255|unique:etudiants,cin,' . $this->route('etudiant'),
                'date_of_birth' => 'sometimes|date',
                'school' => 'sometimes|string|max:255',
            ];
        }
    }
