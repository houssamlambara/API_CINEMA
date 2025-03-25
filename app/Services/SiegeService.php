<?php

namespace App\Services;

use App\Repository\classRepository\SiegeRepository;

class SiegeService
{
    protected $siegeRepository;

    public function __construct(SiegeRepository $siegeRepository)
    {
        $this->siegeRepository = $siegeRepository;
    }

    public function getAll()
    {
        return $this->siegeRepository->getAll();
    }

    public function getById($id)
    {
        return $this->siegeRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->siegeRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->siegeRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->siegeRepository->delete($id);
    }
}

