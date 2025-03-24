<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    protected $fillable = ['nom', 'capacite'];

    public function sieges()
    {
        return $this->hasMany(Siege::class);
    }
}
