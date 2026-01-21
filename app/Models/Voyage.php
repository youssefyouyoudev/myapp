<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'card_id', 'voyage_plan_id', 'amount', 'scanned_at', 'status',"card_id"
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(VoyagePlan::class, 'voyage_plan_id');
    }
}
