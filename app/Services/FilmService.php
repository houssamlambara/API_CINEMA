<?php

namespace App\Services;

use App\Repository\Interface\FilmInterface;
use Illuminate\Support\Facades\Storage;

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
        if (isset($data['image']) && $data['image']->isValid()) {
            $path = $data['image']->store('films', 'public');
            $data['image'] = $path;
        }

        return $this->filmRepository->create($data);
    }

    public function updateFilm($id, array $data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            // Supprimer l'ancienne image si elle existe
            $film = $this->filmRepository->getById($id);
            if ($film && $film->image) {
                Storage::disk('public')->delete($film->image);
            }
            
            $path = $data['image']->store('films', 'public');
            $data['image'] = $path;
        }

        return $this->filmRepository->update($id, $data);
    }

    public function deleteFilm($id)
    {
        // Supprimer l'image associée
        $film = $this->filmRepository->getById($id);
        if ($film && $film->image) {
            Storage::disk('public')->delete($film->image);
        }

        return $this->filmRepository->delete($id);
    }
}
