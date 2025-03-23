<?php

namespace App\Http\Controllers;

use App\Services\SeanceService;
use Illuminate\Http\Request;

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
            'reservation_id' => 'nullable|exists:reservations,id', // Ensure nullable works as intended
        ]);

        // Ensure reservation_id is null if not provided
        $data['reservation_id'] = $data['reservation_id'] ?? null;

        return response()->json($this->seanceService->createSeance($data), 201);
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'film_id' => 'required|exists:films,id', 
            'start_time' => 'required|date', 
            'type' => 'required|string', 
            'langue' => 'required|string',
            'reservation_id' => 'nullable|exists:reservations,id', 
        ]);

        $data['reservation_id'] = $data['reservation_id'] ?? null;

        return response()->json($this->seanceService->updateSeance($id, $data));
    }


    public function destroy($id)
    {
        return response()->json($this->seanceService->deleteSeance($id));
    }
}
