<?php

namespace App\Repository\Interface;

interface PaymentInterface
{
    public function createPayment(array $data);
    public function getPaymentById(int $paymentId);
    public function getPaymentsByUser(int $userId);
}
