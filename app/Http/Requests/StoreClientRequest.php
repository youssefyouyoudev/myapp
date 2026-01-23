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
                'user_id' => 'required|exists:users,id',
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'status' => 'required|in:active,suspended',
                'cin' => 'required|string|max:255|unique:etudiants,cin',
                'date_of_birth' => 'required|date',
                'school' => 'required|string|max:255',
            ];
    }
}
    class StoreEtudiantRequest extends FormRequest
    {
        public function authorize()
        {
            return true;
        }

        public function rules()
        {
            return [
                'user_id' => 'required|exists:users,id',
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'status' => 'required|in:active,suspended',
                'cin' => 'required|string|max:255|unique:etudiants,cin',
                'date_of_birth' => 'required|date',
                'school' => 'required|string|max:255',
            ];
        }
    }
