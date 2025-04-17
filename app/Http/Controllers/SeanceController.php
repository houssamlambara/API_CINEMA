<?php

namespace App\Http\Controllers;

use App\Services\SeanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SeanceController extends Controller
{
    protected $seanceService;

    public function __construct(SeanceService $seanceService)
    {
        $this->seanceService = $seanceService;
    }

    public function index()
    {
        return response()->json($this->seanceService->getAllSeance());
    }

    public function show($id)
    {
        return response()->json($this->seanceService->getSeanceById($id));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'film_id' => 'required|exists:films,id',
            'start_time' => 'required|date',
            'type' => 'required|string',
            'langue' => 'required|string',
            'salle_id' => 'required|exists:salles,id',
        ]);

        return response()->json($this->seanceService->createSeance($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'film_id' => 'nullable|exists:films,id',
            'start_time' => 'nullable|date',
            'type' => 'nullable|string',
            'langue' => 'nullable|string',
            'salle_id' => 'nullable|exists:salles,id',
        ]);

        return response()->json($this->seanceService->updateSeance($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->seanceService->deleteSeance($id));
    }

    public function getSieges($id)
    {
        try {
            $seance = $this->seanceService->getSeanceById($id);
            
            if (!$seance) {
                return response()->json(['error' => 'Séance non trouvée'], 404);
            }

            $salle = $seance->salle;
            Log::info('Salle trouvée:', ['salle_id' => $salle->id ?? null]);
            
            if (!$salle) {
                return response()->json(['error' => 'Salle non trouvée'], 404);
            }

            // Récupérer tous les sièges de la salle
            $sieges = $salle->sieges;
            Log::info('Sièges trouvés:', ['count' => $sieges->count()]);

            if ($sieges->isEmpty()) {
                // Créer automatiquement les sièges pour cette salle
                $capacite = $salle->capacite ?? 32;
                for ($i = 1; $i <= $capacite; $i++) {
                    $salle->sieges()->create([
                        'numero' => $i
                    ]);
                }
                $sieges = $salle->sieges()->get();
                Log::info('Sièges créés:', ['count' => $sieges->count()]);
            }

            // Récupérer les IDs des sièges réservés pour cette séance
            $siegesReserves = $seance->reservations()
                ->whereHas('sieges')
                ->with('sieges')
                ->get()
                ->pluck('sieges.*.id')
                ->flatten()
                ->unique()
                ->toArray();

            Log::info('Sièges réservés:', ['count' => count($siegesReserves)]);

            // Formater la réponse
            $siegesFormates = $sieges->map(function ($siege) use ($siegesReserves) {
                return [
                    'id' => $siege->id,
                    'numero' => $siege->numero,
                    'is_occupied' => in_array($siege->id, $siegesReserves)
                ];
            });

            return response()->json($siegesFormates);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement des sièges: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Impossible de charger les sièges. Veuillez réessayer.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
