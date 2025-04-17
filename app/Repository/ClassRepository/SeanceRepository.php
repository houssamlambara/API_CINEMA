<?php

namespace App\Repository\ClassRepository;

use App\Models\Seance;
use App\Repository\Interface\SeanceInterface;
use Illuminate\Support\Facades\Log;

class SeanceRepository implements SeanceInterface
{
    public function getAll()
    {
        // Récupérer le film_id de la requête s'il existe
        $filmId = request()->query('film_id');
        
        // Construire la requête
        $query = Seance::with(['film', 'salle', 'reservations'])
                      ->orderBy('start_time', 'asc');
        
        // Si un film_id est spécifié, filtrer les séances pour ce film
        if ($filmId) {
            $query->where('film_id', $filmId);
        }
        
        // Exécuter la requête
        $seances = $query->get();

        // Log des données pour débogage
        Log::info('Séances récupérées de la base de données:', [
            'film_id' => $filmId,
            'nombre_total' => $seances->count(),
            'seances' => $seances->map(function($seance) {
                return [
                    'id' => $seance->id,
                    'film_id' => $seance->film_id,
                    'salle_id' => $seance->salle_id,
                    'start_time' => $seance->start_time,
                    'film_titre' => $seance->film ? $seance->film->titre : null,
                    'salle_numero' => $seance->salle ? $seance->salle->numero : null
                ];
            })
        ]);

        return $seances;
    }

    public function getById($id)
    {
        return Seance::with(['film', 'salle', 'reservations'])->findOrFail($id);
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
