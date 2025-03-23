<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'seance_id', 'status'];

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    // Relation avec Seance
    public function seance()
    {
        return $this->belongsTo(Seance::class);
    }
}
