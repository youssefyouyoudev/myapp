<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardSold extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'card_id', 'old_balance', 'new_balance', 'reason', 'created_at',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
