<?php

namespace App\Repository\Interface;

interface TicketInterface
{
    public function generateTicket($paymentId);
}
