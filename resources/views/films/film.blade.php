<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <input type="text" id="titre" name="titre" placeholder="Titre du film" required class="p-2 rounded w-full text-black">
                    <input type="number" id="duree" name="duree" placeholder="Durée (en minutes)" required class="p-2 rounded w-full text-black">
                    <input type="number" id="age_minimum" name="age_minimum" placeholder="Âge minimum" required class="p-2 rounded w-full text-black">
                    <div class="space-y-2">
                        <input type="file" id="image" name="image" accept="image/*" required class="p-2 rounded w-full text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-400 file:text-black hover:file:bg-yellow-500">
                        <div id="image-preview" class="hidden">
                            <img id="preview" src="" alt="Aperçu" class="w-full h-32 object-cover rounded">
                        </div>
                    </div>
                    <input type="text" id="acteur" name="acteur" placeholder="Acteurs principaux" required class="p-2 rounded w-full text-black">
                    <input type="text" id="genre" name="genre" placeholder="Genre" required class="p-2 rounded w-full text-black">
                </div>
                <input type="url" id="bande_annonce" name="bande_annonce" placeholder="Lien de la bande-annonce (facultatif)" class="p-2 rounded w-full text-black">
                <textarea id="description" name="description" rows="3" placeholder="Description" required class="p-2 rounded w-full text-black"></textarea>
                <button type="submit" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 transition">Ajouter</button>
            </form>
            <p id="formMessage" class="mt-4 text-sm"></p>
        </section>

        <!-- Liste des films -->
        <div id="filmsContainer" class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <!-- Films chargés ici -->
        </div>
    </main>

    <!-- Modal pour les séances -->
    <div id="seancesModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-gray-900">
            <div class="mt-3">
                <h3 class="text-2xl font-bold text-yellow-400 mb-4" id="modalTitle">Séances disponibles</h3>
                <div id="seancesContainer" class="mt-2 space-y-4">
                    <!-- Les séances seront chargées ici -->
                </div>
                <div class="mt-4">
                    <button onclick="closeModal()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour les sièges -->
    <div id="siegeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-gray-900">
            <div class="mt-3">
                <h3 class="text-2xl font-bold text-yellow-400 mb-4">Sélection des sièges</h3>
                
                <!-- Écran -->
                <div class="w-full h-8 bg-gray-700 rounded-lg mb-8 text-center text-sm text-gray-400 flex items-center justify-center">
                    ÉCRAN
                </div>

                <!-- Légende -->
                <div class="flex justify-center gap-4 mb-6">
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-gray-600 rounded mr-2"></div>
                        <span class="text-sm">Disponible</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-yellow-400 rounded mr-2"></div>
                        <span class="text-sm">Sélectionné</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-red-500 rounded mr-2"></div>
                        <span class="text-sm">Occupé</span>
                    </div>
                </div>

                <!-- Grille des sièges -->
                <div id="siegeGrid" class="grid grid-cols-8 gap-2 mb-6">
                    <!-- Les sièges seront générés ici -->
                </div>

                <!-- Informations de la réservation -->
                <div class="mb-6">
                    <p class="text-gray-300">Sièges sélectionnés: <span id="selectedSeats" class="text-yellow-400">0</span></p>
                    <p class="text-gray-300">Total: <span id="totalPrice" class="text-yellow-400">0</span> €</p>
                </div>

                <div class="flex justify-end space-x-4">
                    <button onclick="confirmerReservation()" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 transition duration-300">
                        Confirmer
                    </button>
                    <button onclick="closeSiegeModal()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        const container = document.getElementById('filmsContainer');
        const form = document.getElementById('filmForm');
        const message = document.getElementById('formMessage');
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const preview = document.getElementById('preview');

        // Prévisualisation de l'image
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Au début du script, après document.addEventListener('DOMContentLoaded'...
        document.addEventListener('DOMContentLoaded', function() {
            // Vérifier l'authentification au chargement de la page
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = '/login';
                return;
            }

            // Charger les films
            loadFilms();
        });

        async function loadFilms() {
            try {
                const token = localStorage.getItem('token');
                const response = await fetch('/api/films', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });
                const films = await response.json();
                const container = document.getElementById('filmsContainer');
                container.innerHTML = '';

                if (Array.isArray(films) && films.length > 0) {
                    films.forEach(film => {
                        const card = document.createElement('div');
                        card.className = 'bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:scale-105 transition transform duration-300';
                        
                        // Créer une URL pour l'image si c'est un Blob ou utiliser directement le chemin
                        const imgSrc = film.image instanceof Blob ? URL.createObjectURL(film.image) : 
                                     film.image.startsWith('data:') ? film.image : 
                                     `/storage/${film.image}`;
                        
                        card.innerHTML = `
                            <img src="${imgSrc || 'https://via.placeholder.com/300x400'}" alt="${film.titre || 'Film'}" class="w-full h-64 object-cover">
                            <div class="p-5">
                                <h2 class="text-xl font-bold text-yellow-400 mb-2">${film.titre || 'Titre inconnu'}</h2>
                                <p class="text-gray-300 text-sm mb-3">${film.description?.slice(0, 100) || 'Pas de description'}...</p>
                                <div class="flex justify-between items-center text-sm text-gray-400">
                                    <span>🎬 ${film.duree || 'Durée inconnue'} min</span>
                                    <span>🔞 ${film.age_minimum || 'N/A'}+</span>
                                </div>
                                <button onclick="showSeances(${film.id}, '${film.titre}')" 
                                        class="w-full bg-yellow-400 text-black py-2 px-4 rounded hover:bg-yellow-500 transition duration-300">
                                    Voir les séances
                                </button>
                            </div>
                        `;
                        container.appendChild(card);
                    });
                } else {
                    container.innerHTML = '<p class="text-center text-gray-400">Aucun film disponible pour le moment.</p>';
                }
            } catch (error) {
                console.error('Erreur:', error);
                if (error.message.includes('Unauthorized')) {
                    window.location.href = '/login';
                    return;
                }
                container.innerHTML = `
                    <div class="col-span-full text-center text-red-500">
                        Une erreur est survenue lors du chargement des films.
                    </div>
                `;
            }
        }

        // Gérer le formulaire d'ajout
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            
            const formData = new FormData();
            formData.append('titre', document.getElementById('titre').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('duree', document.getElementById('duree').value);
            formData.append('age_minimum', document.getElementById('age_minimum').value);
            formData.append('bande_annonce', document.getElementById('bande_annonce').value);
            formData.append('acteur', document.getElementById('acteur').value);
            formData.append('genre', document.getElementById('genre').value);

            try {
                const response = await fetch('/api/films', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                console.log('Statut de la réponse:', response.status);
                
                const rawResponse = await response.text();
                console.log('Réponse brute:', rawResponse);
                
                let responseData;
                try {
                    responseData = JSON.parse(rawResponse);
                    console.log('Réponse parsée:', responseData);
                } catch (e) {
                    console.error('Erreur de parsing JSON:', e);
                    throw new Error('Le serveur n\'a pas renvoyé une réponse JSON valide');
                }

                if (!response.ok) {
                    throw new Error(responseData.message || 'Une erreur est survenue lors de l\'ajout du film');
                }

                message.textContent = "✅ Film ajouté avec succès !";
                message.className = "mt-4 text-sm text-green-400";
                form.reset();
                imagePreview.classList.add('hidden');
                await loadFilms();

            } catch (error) {
                message.textContent = "❌ " + error.message;
                message.className = "mt-4 text-sm text-red-400";
                console.error('Erreur complète:', error);
            }
        });

        async function showSeances(filmId, filmTitle) {
            try {
                console.log('Chargement des séances pour le film:', filmId);
                const response = await fetch(`/api/seances?film_id=${filmId}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                console.log('Status de la réponse:', response.status);
                const rawText = await response.text();
                console.log('Réponse brute:', rawText);
                
                let seances;
                try {
                    seances = JSON.parse(rawText);
                    console.log('Données parsées:', seances);
                } catch (e) {
                    console.error('Erreur parsing JSON:', e);
                    throw new Error('La réponse du serveur n\'est pas un JSON valide');
                }
                
                const modal = document.getElementById('seancesModal');
                const modalTitle = document.getElementById('modalTitle');
                const seancesContainer = document.getElementById('seancesContainer');
                
                modalTitle.textContent = `Séances pour ${filmTitle}`;
                seancesContainer.innerHTML = '';

                if (Array.isArray(seances) && seances.length > 0) {
                    console.log(`Traitement de ${seances.length} séances`);
                    seances.forEach((seance, index) => {
                        console.log(`Traitement séance ${index + 1}:`, seance);
                        
                        let dateStr = 'Date non disponible';
                        let timeStr = 'Heure non disponible';
                        
                        try {
                            if (seance.start_time) {
                                console.log('Date originale:', seance.start_time);
                                const date = new Date(seance.start_time);
                                dateStr = date.toLocaleDateString('fr-FR', {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                                timeStr = date.toLocaleTimeString('fr-FR', {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                });
                            }
                        } catch (e) {
                            console.error('Erreur formatage date:', e, seance.start_time);
                        }

                        const seanceElement = document.createElement('div');
                        seanceElement.className = 'bg-gray-800 p-4 rounded-lg mb-4';
                        seanceElement.innerHTML = `
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                                <div class="flex-grow">
                                    <p class="text-yellow-400 text-lg font-semibold">${dateStr}</p>
                                    <p class="text-gray-300">${timeStr}</p>
                                    <p class="text-gray-400">Type: ${seance.type || 'Non spécifié'}</p>
                                    <p class="text-gray-400">Langue: ${seance.langue || 'Non spécifiée'}</p>
                                    <p class="text-gray-400">Salle: ${seance.salle ? seance.salle.numero : 'Non spécifiée'}</p>
                                    <p class="text-gray-400">Places disponibles: ${seance.places_disponibles ?? 'Non spécifié'}</p>
                                </div>
                                <div class="flex flex-col space-y-2 w-full md:w-auto">
                                    <button onclick="reserverSeance(${seance.id})" 
                                            class="bg-yellow-400 text-black px-6 py-2 rounded hover:bg-yellow-500 transition duration-300 w-full md:w-auto text-center">
                                        Réserver
                                    </button>
                                </div>
                            </div>
                        `;
                        seancesContainer.appendChild(seanceElement);
                    });
                } else {
                    console.log('Aucune séance trouvée');
                    seancesContainer.innerHTML = `
                        <div class="text-center text-gray-400 p-4">
                            <p class="text-xl mb-2">Aucune séance disponible pour ce film.</p>
                            <p class="text-sm">(Données reçues: ${JSON.stringify(seances)})</p>
                        </div>
                    `;
                }

                modal.classList.remove('hidden');
            } catch (error) {
                console.error('Erreur détaillée:', error);
                alert('Une erreur est survenue lors du chargement des séances: ' + error.message);
            }
        }

        function closeModal() {
            document.getElementById('seancesModal').classList.add('hidden');
        }

        let selectedSeats = new Set();
        let currentSeanceId = null;
        let seatsData = null;
        const PRICE_PER_SEAT = 9.99;

        function showSiegeModal(seanceId) {
            currentSeanceId = seanceId;
            const modal = document.getElementById('siegeModal');
            const grid = document.getElementById('siegeGrid');
            grid.innerHTML = '';

            // Simuler le chargement des sièges depuis l'API
            loadSeatsForSeance(seanceId);

            modal.classList.remove('hidden');
        }

        async function loadSeatsForSeance(seanceId) {
            try {
                const token = localStorage.getItem('token');
                const response = await fetch(`/api/seances/${seanceId}/sieges`, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });

                if (!response.ok) {
                    throw new Error('Erreur lors du chargement des sièges');
                }

                const data = await response.json();
                seatsData = data;
                renderSeats(data);
            } catch (error) {
                console.error('Erreur:', error);
                alert('Impossible de charger les sièges. Veuillez réessayer.');
            }
        }

        function renderSeats(seats) {
            const grid = document.getElementById('siegeGrid');
            grid.innerHTML = '';

            // Générer 32 sièges (4 rangées de 8)
            for (let i = 0; i < 32; i++) {
                const row = Math.floor(i / 8) + 1;
                const seat = (i % 8) + 1;
                const seatNumber = `${String.fromCharCode(64 + row)}${seat}`;

                const seatElement = document.createElement('div');
                seatElement.className = `
                    w-8 h-8 rounded cursor-pointer flex items-center justify-center text-sm
                    ${seats?.[i]?.is_occupied ? 'bg-red-500 cursor-not-allowed' : 'bg-gray-600 hover:bg-gray-500'}
                `;
                seatElement.textContent = seatNumber;
                seatElement.dataset.seatId = i + 1;

                if (!seats?.[i]?.is_occupied) {
                    seatElement.onclick = () => toggleSeat(seatElement, i + 1);
                }

                grid.appendChild(seatElement);
            }
        }

        function toggleSeat(element, seatId) {
            if (selectedSeats.has(seatId)) {
                selectedSeats.delete(seatId);
                element.classList.remove('bg-yellow-400');
                element.classList.add('bg-gray-600');
            } else {
                selectedSeats.add(seatId);
                element.classList.remove('bg-gray-600');
                element.classList.add('bg-yellow-400');
            }

            updateReservationInfo();
        }

        function updateReservationInfo() {
            document.getElementById('selectedSeats').textContent = selectedSeats.size;
            document.getElementById('totalPrice').textContent = (selectedSeats.size * PRICE_PER_SEAT).toFixed(2);
        }

        function closeSiegeModal() {
            document.getElementById('siegeModal').classList.add('hidden');
            selectedSeats.clear();
            updateReservationInfo();
        }

        async function confirmerReservation() {
            if (selectedSeats.size === 0) {
                alert('Veuillez sélectionner au moins un siège.');
                return;
            }

            try {
                const token = localStorage.getItem('token');
                const response = await fetch('/api/reservations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`,
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        seance_id: currentSeanceId,
                        siege_ids: Array.from(selectedSeats),
                        status: 'En Attente'
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Erreur lors de la réservation');
                }

                // Afficher le message de succès
                const successModal = document.createElement('div');
                successModal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                successModal.innerHTML = `
                    <div class="bg-gray-900 p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
                        <h3 class="text-xl font-bold text-yellow-400 mb-4">Réservation réussie !</h3>
                        <p class="text-gray-300 mb-6">Votre réservation a été enregistrée avec succès. Vous pouvez consulter vos réservations dans votre espace personnel.</p>
                        <div class="flex justify-end space-x-4">
                            <button onclick="window.location.href='/reservation'" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 transition duration-300">
                                Voir mes réservations
                            </button>
                            <button onclick="this.parentElement.parentElement.parentElement.remove()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">
                                Fermer
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(successModal);

                // Fermer les modals
                closeSiegeModal();
                closeModal();

            } catch (error) {
                console.error('Erreur:', error);
                alert('Erreur lors de la réservation: ' + error.message);
            }
        }

        // Mettre à jour la fonction reserverSeance pour utiliser le modal de sièges
        function reserverSeance(seanceId) {
            showSiegeModal(seanceId);
        }
    </script>
</body>

</html>
