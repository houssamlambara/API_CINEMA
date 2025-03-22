<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'image',
        'duree',
        'age_minimum',
        'bande_annonce',
        'acteur',
        'genre',
    ];
}
