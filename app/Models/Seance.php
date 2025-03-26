<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    protected $table = 'seances';
    protected $fillable = ['film_id', 'start_time', 'type', 'langue','salle_id'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
