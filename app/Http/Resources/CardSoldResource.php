<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardSoldResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cardUuid' => optional($this->card)->uuid,
            'oldBalance' => $this->old_balance,
            'newBalance' => $this->new_balance,
            'reason' => $this->reason,
            'createdAt' => $this->created_at,
        ];
    }
}
