<?php

namespace App\Repository\ClassRepository;

use App\Models\Siege;

class SiegeRepository
{
    public function getAll()
    {
        return Siege::all();
    }

    public function getById($id)
    {
        return Siege::find($id);
    }

    public function create(array $data)
    {
        return Siege::create($data);
    }

    public function update($id, array $data)
    {
        // Trouver le siège par ID
        $siege = Siege::findOrFail($id);

        // Mettre à jour les données du siège
        $siege->update($data);

        // Retourner le siège mis à jour
        return $siege;
    }

    public function delete($id)
    {
        $siege = Siege::find($id);
        if ($siege) {
            $siege->delete();
            return true;
        }
        return false;
    }
}
