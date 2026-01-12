<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id',
            'card_id' => 'required|exists:cards,id',
            'amount' => 'required|numeric|min:0.01',
            'method' => 'required|in:cash,card,mobile',
            'reference' => 'nullable|string|max:255',
        ];
    }
}
