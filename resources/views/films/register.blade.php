@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Ajouter un nouveau film</h2>
                
                <form id="film-form" class="space-y-6">
                    <div>
                        <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
                        <input type="text" id="titre" name="titre" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="3" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">URL de l'image</label>
                        <input type="url" id="image" name="image" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="duree" class="block text-sm font-medium text-gray-700">Durée (en minutes)</label>
                        <input type="number" id="duree" name="duree" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="age_minimum" class="block text-sm font-medium text-gray-700">Âge minimum</label>
                        <input type="number" id="age_minimum" name="age_minimum" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="bande_annonce" class="block text-sm font-medium text-gray-700">URL de la bande annonce</label>
                        <input type="url" id="bande_annonce" name="bande_annonce" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="acteur" class="block text-sm font-medium text-gray-700">Acteurs</label>
                        <input type="text" id="acteur" name="acteur" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                        <input type="text" id="genre" name="genre" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <button type="submit" 
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ajouter le film
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/components/FilmRegister.js'])
@endsection 