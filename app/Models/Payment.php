<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'client_id', 'card_id', 'amount', 'method', 'reference',"user_id"
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
