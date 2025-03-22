<?php

namespace App\Repository\ClassRepository;

use App\Models\Film;
use App\Repository\Interface\FilmInterface;

class FilmRepository implements FilmInterface
{
    public function getAll()
    {
        return Film::all();
    }

    public function getById($id)
    {
        return Film::findOrFail($id);
    }

    public function create(array $data)
    {
        return Film::create($data);
    }

    public function update($id, array $data)
    {
        $film = Film::findOrFail($id);

        $film->update($data);

        return $film;
    }


    public function delete($id)
    {
        $film = Film::find($id);

        if ($film) {
            $film->delete();
            return true; 
        }

        return false; 
    }
}
