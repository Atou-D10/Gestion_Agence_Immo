<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Visit;
use App\Models\Contract;
use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    protected $fillable = [
        'titre', 'description', 'prix', 'surface', 'localisation',
        'statut', 'type', 'pieces'
    ];

    // Images liées au bien
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    // Visites programmées pour ce bien
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    // Contrats associés à ce bien
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    // Messages envoyés à propos de ce bien
    public function messages(): HasMany
    {
        return $this->hasMany(ContactMessage::class);
    }
}