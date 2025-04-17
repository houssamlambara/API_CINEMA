<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Enregistrer une Séance - CinéHall</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-800 text-white font-sans">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white shadow-lg w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-yellow-400 text-2xl font-bold">🎬 CinéHall</span>
                </div>
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="#" class="hover:text-yellow-400 transition duration-300">Accueil</a>
                    <a href="#" class="hover:text-yellow-400 transition duration-300">Films</a>
                    <a href="#" class="hover:text-yellow-400 transition duration-300">Séances</a>
                    <a href="#" class="hover:text-yellow-400 transition duration-300">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Formulaire d'enregistrement de séance -->
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-gray-900 rounded-xl">
        <h2 class="text-2xl font-bold text-yellow-400 mb-6">Enregistrer une Séance</h2>
        
        <form id="seanceForm" method="POST">
            <div class="mb-4">
                <label for="film_id" class="block text-sm font-medium text-white">Film</label>
                <input type="number" name="film_id" id="film_id" placeholder="ID du Film" required class="p-2 w-full rounded text-black mt-2">
            </div>

            <div class="mb-4">
                <label for="start_time" class="block text-sm font-medium text-white">Heure de début</label>
                <input type="datetime-local" name="start_time" id="start_time" required class="p-2 w-full rounded text-black mt-2">
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-white">Type de Séance</label>
                <input type="text" name="type" id="type" placeholder="Type de Séance" required class="p-2 w-full rounded text-black mt-2">
            </div>

            <div class="mb-4">
                <label for="langue" class="block text-sm font-medium text-white">Langue</label>
                <input type="text" name="langue" id="langue" placeholder="Langue de la séance" required class="p-2 w-full rounded text-black mt-2">
            </div>

            <div class="mb-4">
                <label for="salle_id" class="block text-sm font-medium text-white">Salle</label>
                <input type="number" name="salle_id" id="salle_id" placeholder="ID de la Salle" required class="p-2 w-full rounded text-black mt-2">
            </div>

            <button type="submit" class="bg-yellow-400 text-black px-4 py-2 rounded mt-4">Enregistrer la Séance</button>

            <p id="responseMsg" class="mt-4 text-sm"></p>
        </form>
    </div>

    <script>
        const form = document.getElementById('seanceForm');
        const msg = document.getElementById('responseMsg');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('http://localhost:8000/api/seances', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer VOTRE_TOKEN_JWT_ICI', // ⚠️ Remplace par le vrai token JWT
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Erreur lors de l\'enregistrement de la séance');
                }

                msg.textContent = "✅ Séance enregistrée avec succès!";
                msg.className = "text-green-400";
                form.reset();
            } catch (error) {
                msg.textContent = "❌ Échec de l'enregistrement de la séance.";
                msg.className = "text-red-400";
                console.error(error);
            }
        });
    </script>

</body>

</html>
