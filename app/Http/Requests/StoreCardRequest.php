<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'nfc_uid' => 'required|string|unique:cards,nfc_uid',
            'balance' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:active,blocked,expired,lost',
            'start_date' => 'required|date',
            'expiration_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}
