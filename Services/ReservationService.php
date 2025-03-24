<?php

namespace App\Services;

use App\Repository\Interface\ReservationInterface;
use Illuminate\Support\Facades\Auth;

class ReservationService
{
    protected $reservationRepository;

    public function __construct(ReservationInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function createReservation($seanceId)
    {
        $userId = Auth::id();
        return $this->reservationRepository->createReservation($seanceId, $userId);
    }
}
