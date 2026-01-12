<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'userUuid' => optional($this->user)->uuid,
            'clientUuid' => optional($this->client)->uuid,
            'cardUuid' => optional($this->card)->uuid,
            'amount' => $this->amount,
            'method' => $this->method,
            'reference' => $this->reference,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
