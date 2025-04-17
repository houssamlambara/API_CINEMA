<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    protected $table = 'seances';
    protected $fillable = ['film_id', 'start_time', 'type', 'langue', 'salle_id'];

    protected $with = ['film', 'salle']; 

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getPlacesDisponiblesAttribute()
    {
        $capaciteSalle = $this->salle ? $this->salle->capacite : 0;
        $placesReservees = $this->reservations()->count();
        return $capaciteSalle - $placesReservees;
    }
}
