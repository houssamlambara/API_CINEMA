<?php

namespace App\Repository\ClassRepository;

use App\Repository\Interface\TicketInterface;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class TicketRepository implements TicketInterface
{
    public function generateTicket($payment)
    {
        // Charger les données pour le ticket
        $data = [
            'ticket_id' => uniqid('TICKET-'),
            'user' => $payment->user->name,
            'reservation' => $payment->reservation,
            'amount' => $payment->amount,
            'status' => $payment->status,
            'created_at' => now(),
        ];

        // Générer le PDFà
        $pdf = PDF::loadView('pdf.ticket', $data);
        $pdfPath = 'tickets/ticket_' . $data['ticket_id'] . '.pdf';

        // Stocker le fichier
        Storage::put($pdfPath, $pdf->output());

        // Enregistrer dans la base de données
        return Ticket::create([
            'user_id' => $payment->user_id,
            'reservation_id' => $payment->reservation_id,
            'ticket_number' => $data['ticket_id'],
            'pdf_path' => $pdfPath,
        ]);
    }
}
