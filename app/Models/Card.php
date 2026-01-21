<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid', 'client_id', 'nfc_uid', 'balance', 'status',
    ];

    public function subscriptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Subscription::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function activeVoyage()
    {
        return $this->hasOne(Voyage::class)->where('status', 'active');
    }

    public function voyages(): HasMany
    {
        return $this->hasMany(Voyage::class);
    }

    public function cardSolds(): HasMany
    {
        return $this->hasMany(CardSold::class);
    }
}
