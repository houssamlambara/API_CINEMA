<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use App\Services\SalleService;

class SalleController extends Controller
{
    protected $salleService;

    public function __construct(SalleService $salleService)
    {
        $this->salleService = $salleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->salleService->getAllSalles());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données reçues
        $data = $request->validate([
            'nom' => 'required|string|max:255',  
            'capacite' => 'required|integer',  
            'type' => 'required|string|max:255', 
        ]);

        // Créer la salle avec les données validées
        $salle = Salle::create($data);

        return response()->json([
            'message' => 'Salle créée avec succès',
            'salle' => $salle
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $salle = $this->salleService->getSalleById($id);

        if (!$salle) {
            return response()->json(['error' => 'Salle non trouvée'], 404);
        }

        return response()->json($salle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nom' => 'sometimes|required|string|max:255'
        ]);

        $updated = $this->salleService->updateSalle($id, $data);

        if (!$updated) {
            return response()->json(['error' => 'Salle non trouvée'], 404);
        }

        return response()->json(['message' => 'Salle mise à jour avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted = $this->salleService->deleteSalle($id);

        if (!$deleted) {
            return response()->json(['error' => 'Salle non trouvée'], 404);
        }

        return response()->json(['message' => 'Salle supprimée avec succès']);
    }
}
