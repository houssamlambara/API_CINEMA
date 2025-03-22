<?php

namespace App\Http\Controllers;

use App\Services\FilmService;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    protected $filmService;

    public function __construct(FilmService $filmService)
    {
        $this->filmService = $filmService;
    }

    public function index()
    {
        return response()->json($this->filmService->getAllFilms());
    }

    public function show($id)
    {
        return response()->json($this->filmService->getFilmById($id));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string',
            'duree' => 'required|string',
            'age_minimum' => 'required|integer',
            'bande_annonce' => 'string',
            'acteur' => 'required|string',
            'genre' => 'required|string',
        ]);


        return response()->json($this->filmService->createFilm($data), 201);
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'duree' => 'nullable|string',
            'age_minimum' => 'nullable|integer',
            'bande_annonce' => 'nullable|string',
            'acteur' => 'nullable|string',
            'genre' => 'nullable|string',
        ]);

        $updatedFilm = $this->filmService->updateFilm($id, $data);

        return response()->json($updatedFilm);
    }


    public function delete($id)
{
    $deleted = $this->filmService->deleteFilm($id);

    if ($deleted) {
        return response()->json(['message' => 'Film supprimé avec succès.'], 200);
    } else {
        return response()->json(['message' => 'Film introuvable ou déjà supprimé.'], 404);
    }
}

}
