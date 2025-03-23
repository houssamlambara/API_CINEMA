<?php

namespace App\Repository\Interface;

interface ReservationInterface
{
    public function createReservation($seanceId, $userId);
}
