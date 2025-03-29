<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function generate($paymentId)
    {
        $ticket = $this->ticketService->processTicket($paymentId);
        return response()->json(['message' => 'Ticket généré avec succès', 'ticket' => $ticket]);
    }
}
