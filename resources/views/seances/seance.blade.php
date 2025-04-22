<!-- filepath: c:\Users\safiy\Desktop\API_CINEMA\resources\views\seances\seance.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Liste des séances</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                    <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Film</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Salle</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Langue</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Date et Heure</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Réservations</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($seances as $seance)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $seance['id'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset($seance['film']['image']) }}" alt="Film Image" class="w-12 h-12 object-cover rounded">
                            <span class="font-medium">{{ $seance['film']['titre'] }}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="font-medium">{{ $seance['salle']['nom'] }}</span>
                        <span class="text-sm text-gray-500">({{ $seance['salle']['type'] }})</span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $seance['type'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $seance['langue'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ \Carbon\Carbon::parse($seance['start_time'])->format('d/m/Y H:i') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ count($seance['reservations']) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection