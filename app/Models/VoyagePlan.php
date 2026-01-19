<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoyagePlan extends Model
{
    protected $fillable = ['price', 'number_of_voyages', 'expiration'];

    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
}
