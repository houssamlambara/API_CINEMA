<?php

namespace App\Services;

use App\Models\Salle;
use App\Repository\Interface\SalleInterface;

class SalleService
{
    protected $salleRepository;

    public function __construct(SalleInterface $salleRepository)
    {
        $this->salleRepository = $salleRepository;
    }

    public function createSalle(array $data): Salle
    {
        return $this->salleRepository->create($data);
    }

    public function getAllSalles()
    {
        return $this->salleRepository->getAll();
    }

    public function getSalleById(int $id): ?Salle
    {
        return $this->salleRepository->findById($id);
    }

    public function updateSalle(int $id, array $data): bool
    {
        return $this->salleRepository->update($id, $data);
    }

    public function deleteSalle(int $id): bool
    {
        return $this->salleRepository->delete($id);
    }
}
