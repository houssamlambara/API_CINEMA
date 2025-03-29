<?php

namespace App\Services;

use App\Repository\Interface\PaymentInterface;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment(array $data)
    {
        return $this->paymentRepository->createPayment($data);
    }

    public function getPaymentById(int $paymentId)
    {
        return $this->paymentRepository->getPaymentById($paymentId);
    }

    public function getPaymentsByUser(int $userId)
    {
        return $this->paymentRepository->getPaymentsByUser($userId);
    }
}
