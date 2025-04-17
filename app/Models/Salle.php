<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'capacite', 'type'];

    public function seances()
    {
        return $this->hasMany(Seance::class);
    }

    public function sieges(): HasMany
    {
        return $this->hasMany(Siege::class);
    }
}
