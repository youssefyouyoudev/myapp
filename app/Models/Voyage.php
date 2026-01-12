<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'card_id', 'amount', 'scanned_at',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
