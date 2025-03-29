<?php

namespace App\Repository\ClassRepository;

use App\Models\Payment;
use App\Repository\Interface\PaymentInterface;

class PaymentRepository implements PaymentInterface
{
    public function createPayment(array $data)
    {
        return Payment::create($data);
    }

    public function getPaymentById(int $paymentId)
    {
        return Payment::find($paymentId);
    }

    public function getPaymentsByUser(int $userId)
    {
        return Payment::where('user_id', $userId)->get();
    }
}
