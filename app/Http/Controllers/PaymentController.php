<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createPayment(Request $request)
    {
        // Validation des données du paiement
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric',
            'status' => 'required|string'
        ]);

        // Création du paiement
        $payment = $this->paymentService->createPayment($data);

        return response()->json([
            'message' => 'Paiement créé avec succès',
            'payment' => $payment
        ]);
    }

    public function getPaymentById(int $paymentId)
    {
        $payment = $this->paymentService->getPaymentById($paymentId);

        if ($payment) {
            return response()->json($payment);
        }

        return response()->json(['error' => 'Paiement non trouvé'], 404);
    }

    public function getPaymentsByUser(int $userId)
    {
        $payments = $this->paymentService->getPaymentsByUser($userId);

        return response()->json($payments);
    }
}
