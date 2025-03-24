<?php

namespace App\Services;

use App\Repository\Interface\FilmInterface;

class FilmService
{
    protected $filmRepository;

    public function __construct(FilmInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function getAllFilms()
    {
        return $this->filmRepository->getAll();
    }

    public function getFilmById($id)
    {
        return $this->filmRepository->getById($id);
    }

    public function createFilm(array $data)
    {
        return $this->filmRepository->create($data);
    }

    public function updateFilm($id, array $data)
    {
        return $this->filmRepository->update($id, $data);
    }

    public function deleteFilm($id)
    {
        return $this->filmRepository->delete($id);
    }
}
