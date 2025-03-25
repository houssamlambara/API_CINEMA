<?php

namespace App\Http\Controllers;

use App\Services\SiegeService;
use Illuminate\Http\Request;
use App\Models\Siege;

class SiegeController extends Controller
{
    protected $siegeService;

    public function __construct(SiegeService $siegeService)
    {
        $this->siegeService = $siegeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->siegeService->getAll());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id)
    {
        return response()->json($this->siegeService->getById($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $data = $request->validate([
            'salle_id' => 'required|exists:salles,id',
        ]);

        // Appel au service pour créer le siege
        return response()->json($this->siegeService->create($data), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $data = $request->validate([
        'salle_id' => 'required|exists:salles,id',
    ]);

    $siege = Siege::findOrFail($id);
    $siege->update($data);

    return response()->json($siege);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->siegeService->delete($id));
    }
}
