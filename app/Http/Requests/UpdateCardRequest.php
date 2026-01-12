<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => 'sometimes|exists:clients,id',
            'nfc_uid' => 'sometimes|string|unique:cards,nfc_uid,' . $this->route('card')->id,
            'balance' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:active,blocked,expired,lost',
            'start_date' => 'sometimes|date',
            'expiration_date' => 'sometimes|date|after_or_equal:start_date',
        ];
    }
}
