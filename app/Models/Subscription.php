<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'client_id', 'subscription_plan_id', 'type', 'price', 'start_date', 'end_date', 'status','card_id',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }
}
