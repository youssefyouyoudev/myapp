<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Import the Storage facade
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etudiant extends Model
{
    use HasFactory;

    // Make sure all your fields are here.
    protected $fillable = [
        'user_id', 'nom', 'prenom', 'etablissement', 'email', 'telephone', 'adresse',
        'carte_nationale', 'carte_etudiant', 'img_user', 'img_carte_nationale',
        'img_carte_nationale_verso', 'img_carte_etudiant'
    ];

    /**
     * The "booted" method of the model.
     * This will automatically delete images when an Etudiant is deleted.
     */
    protected static function booted()
    {
        static::deleting(function ($etudiant) {
            $imageFields = ['img_user', 'img_carte_nationale', 'img_carte_nationale_verso', 'img_carte_etudiant'];
            foreach ($imageFields as $field) {
                if ($etudiant->{$field}) {
                    Storage::disk('public')->delete($etudiant->{$field});
                }
            }
        });
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function card(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Card::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active');
    }

    public function activeVoyage()
    {
        return $this->hasOne(Voyage::class);
    }

    public function hasActivePlan()
    {
        return $this->activeSubscription()->exists() || $this->activeVoyage()->exists();
    }
}
