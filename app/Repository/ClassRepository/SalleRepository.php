<?php

namespace App\Repository\ClassRepository; 

use App\Models\Salle;
use App\Repository\Interface\SalleInterface;

class SalleRepository implements SalleInterface
{
    public function create(array $data): Salle
    {
        return Salle::create($data);
    }

    public function getAll()
    {
        return Salle::all();
    }

    public function findById(int $id): ?Salle
    {
        return Salle::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $salle = Salle::find($id);
        if ($salle) {
            return $salle->update($data);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        $salle = Salle::find($id);
        if ($salle) {
            return $salle->delete();
        }
        return false;
    }
}
