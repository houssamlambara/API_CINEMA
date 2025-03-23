<?php

namespace App\Repository\ClassRepository;

use App\Repository\Interface\ReservationInterface;
use App\Models\Reservation;

class ReservationRepository implements ReservationInterface
{
    public function createReservation($seanceId, $userId)
    {
        return Reservation::create([
            'seance_id' => $seanceId,
            'user_id' => $userId
        ]);
    }
}
