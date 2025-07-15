<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    protected $fillable = ['nom', 'email', 'telephone', 'message', 'property_id'];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
