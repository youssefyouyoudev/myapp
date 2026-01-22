<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $fillable = [
        'card_id',
        'validated_at',
    ];
}
