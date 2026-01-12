<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'client' => new ClientResource($this->whenLoaded('client')),
            'nfcUid' => $this->nfc_uid,
            'balance' => $this->balance,
            'status' => $this->status,
            'startDate' => $this->start_date,
            'expirationDate' => $this->expiration_date,
            'voyages' => VoyageResource::collection($this->whenLoaded('voyages')),
            'cardSolds' => CardSoldResource::collection($this->whenLoaded('cardSolds')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
