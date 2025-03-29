<?php

namespace App\Services;

use App\Repository\Interface\TicketInterface;
use App\Models\Payment;

class TicketService
{
    protected $ticketRepository;

    public function __construct(TicketInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function processTicket($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        return $this->ticketRepository->generateTicket($payment);
    }
}
