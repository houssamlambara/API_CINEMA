<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films - CinéHall</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-900 items-center justify-center text-white font-sans">

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
                <div id="userArea" class="space-x-4 flex items-center"></div>
            </div>
        </div>
    </nav>

    <!-- Section Films -->
    <main class="p-8 bg-gray-900 min-h-screen text-white">
        <h1 class="text-4xl font-bold text-yellow-400 mb-10 text-center">🎥 Tous les Films</h1>

        <!-- Formulaire d'ajout -->
        <section class="max-w-3xl mx-auto mb-10 p-6 bg-gray-800 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-4 text-yellow-400">Ajouter un nouveau film</h2>
            <form id="filmForm" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="titre" placeholder="Titre du film" required class="p-2 rounded w-full text-black">
                    <input type="text" name="duree" placeholder="Durée (ex: 2h15)" required class="p-2 rounded w-full text-black">
                    <input type="number" name="age_minimum" placeholder="Âge minimum" required class="p-2 rounded w-full text-black">
                    <input type="text" name="image" placeholder="URL de l'image" required class="p-2 rounded w-full text-black">
                    <input type="text" name="acteur" placeholder="Acteurs principaux" required class="p-2 rounded w-full text-black">
                    <input type="text" name="genre" placeholder="Genre" required class="p-2 rounded w-full text-black">
                </div>
                <input type="text" name="bande_annonce" placeholder="Lien de la bande-annonce (facultatif)" class="p-2 rounded w-full text-black">
                <textarea name="description" rows="3" placeholder="Description" required class="p-2 rounded w-full text-black w-full"></textarea>
                <button type="submit" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 transition">Ajouter</button>
            </form>
            <p id="formMessage" class="mt-4 text-sm"></p>
        </section>

        <!-- Liste des films -->
        <div id="filmsContainer" class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <!-- Films chargés ici -->
        </div>
    </main>

    <!-- Scripts -->
    <script>
        const container = document.getElementById('filmsContainer');
        const form = document.getElementById('filmForm');
        const message = document.getElementById('formMessage');

        // Charger les films existants
        async function loadFilms() {
            try {
                const response = await fetch('http://localhost:8000/api/films');
                const films = await response.json();

                container.innerHTML = ''; // Vide avant de recharger

                if (Array.isArray(films) && films.length > 0) {
                    films.forEach(film => {
                        const card = document.createElement('div');
                        card.className = 'bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:scale-105 transition transform duration-300';
                        card.innerHTML = `
                            <img src="${film.image || 'https://via.placeholder.com/300x400'}" alt="${film.titre || 'Film'}" class="w-full h-64 object-cover">
                            <div class="p-5">
                                <h2 class="text-xl font-bold text-yellow-400 mb-2">${film.titre || 'Titre inconnu'}</h2>
                                <p class="text-gray-300 text-sm mb-3">${film.description?.slice(0, 100) || 'Pas de description'}...</p>
                                <div class="flex justify-between items-center text-sm text-gray-400">
                                    <span>🎬 ${film.duree || 'Durée inconnue'}</span>
                                    <span>🔞 ${film.age_minimum || 'N/A'}+</span>
                                </div>
                            </div>
                        `;
                        container.appendChild(card);
                    });
                } else {
                    container.innerHTML = '<p class="text-red-500 text-center">❌ Aucun film trouvé.</p>';
                }
            } catch (error) {
                container.innerHTML = '<p class="text-red-500 text-center">❌ Erreur lors du chargement des films.</p>';
                console.error(error);
            }
        }

        // Gérer le formulaire d'ajout
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('http://localhost:8000/api/films/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // 'Authorization': 'Bearer TOKEN' // Si nécessaire
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    throw new Error('Erreur API');
                }

                message.textContent = "✅ Film ajouté avec succès !";
                message.className = "text-green-400";

                form.reset();
                loadFilms(); // Recharger les films
            } catch (error) {
                message.textContent = "❌ Échec de l'ajout du film.";
                message.className = "text-red-400";
                console.error(error);
            }
        });

        loadFilms();
    </script>
</body>

</html>
