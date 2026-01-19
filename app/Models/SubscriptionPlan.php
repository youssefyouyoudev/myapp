<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $fillable = ['name', 'price', 'type'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
