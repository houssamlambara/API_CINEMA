<?php

namespace App\Services;

use App\Repository\Interface\SeanceInterface;

class SeanceService
{
    protected $seanceRepository;

    public function __construct(SeanceInterface $seanceRepository)
    {
        $this->seanceRepository = $seanceRepository;
    }

    public function getAllSeance()
    {
        return $this->seanceRepository->getAll();
    }

    public function getSeanceById($id)
    {
        return $this->seanceRepository->getById($id);
    }

    public function createSeance($data)
    {
        return $this->seanceRepository->create($data);
    }

    public function updateSeance($id, $data)
    {
        return $this->seanceRepository->update($id, $data);
    }

    public function deleteSeance($id)
    {
        return $this->seanceRepository->delete($id);
    }
}
