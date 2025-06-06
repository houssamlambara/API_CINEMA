<?php

namespace App\Repository\Interface;

interface FilmInterface
{
    public function getAll(); 
    public function getById($id); 
    public function create(array $data); 
    public function update($id, array $data); 
    public function delete($id); 
}
