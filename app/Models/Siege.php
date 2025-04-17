<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Siege extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'salle_id'];

    // Relation avec Salle
    public function salle(): BelongsTo
    {
        return $this->belongsTo(Salle::class);
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'reservation_siege')
            ->withTimestamps();
    }
}
