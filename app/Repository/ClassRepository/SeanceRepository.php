<?php

namespace App\Repository\ClassRepository;

use App\Models\Seance;
use App\Repository\Interface\SeanceInterface;

class SeanceRepository implements SeanceInterface
{
    public function getAll()
    {
        return Seance::with('film', 'reservation')->get();
    }

    public function getById($id)
    {
        return Seance::with('film', 'reservation')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Seance::create($data);
    }

    public function update($id, array $data)
    {
        $seance = Seance::findOrFail($id);
        $seance->update($data);
        return $seance;
    }

    public function delete($id)
    {
        return Seance::destroy($id);
    }
}
