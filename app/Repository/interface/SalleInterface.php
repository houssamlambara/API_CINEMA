<?php

namespace App\Repository\Interface;

interface SalleInterface
{
    public function create(array $data);
    public function getAll();
    public function findById(int $id);
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
