<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function sieges(): BelongsToMany
    {
        return $this->belongsToMany(Siege::class, 'reservation_siege')
            ->withTimestamps();
    }
}
