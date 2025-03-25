<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\ReservationService;


class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate(); // Récupérer l'utilisateur connecté

        $request->validate([
            'seance_id' => 'required|exists:seances,id',
            'status' => 'in:En Attente,confirmer,Annuler'
        ]);

        $reservation = Reservation::create([
            'user_id' => $user->id, // Utiliser l'ID de l'utilisateur authentifié
            'seance_id' => $request->seance_id,
            'status' => $request->status ?? 'En Attente'
        ]);

        return response()->json([
            'message' => 'Réservation créée avec succès',
            'reservation' => $reservation
        ], 201);
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $user = JWTAuth::parseToken()->authenticate(); // Récupérer l'utilisateur connecté

        // Vérifier si l'utilisateur est bien le propriétaire de la réservation
        if ($reservation->user_id !== $user->id) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        $request->validate([
            'status' => 'required|in:En Attente,confirmer,Annuler'
        ]);

        $reservation->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Statut mis à jour avec succès',
            'reservation' => $reservation
        ]);
    }
}
