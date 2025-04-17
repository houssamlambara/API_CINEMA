<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription - CinéHall</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-900 items-center justify-center text-white font-sans">
    <!-- Navbar -->
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo / Titre -->
                <div class="flex items-center space-x-2">
                    <span class="text-yellow-400 text-2xl font-bold">🎬 CinéHall</span>
                </div>

                <!-- Liens -->
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="#" class="hover:text-yellow-400 transition duration-300">Accueil</a>
                    <a href="#" class="hover:text-yellow-400 transition duration-300">Films</a>
                    <a href="#" class="hover:text-yellow-400 transition duration-300">Séances</a>
                    <a href="#" class="hover:text-yellow-400 transition duration-300">Contact</a>
                </div>

                <!-- Espace utilisateur -->
                <div id="userArea" class="space-x-4 flex items-center">
                    <!-- Contenu JS -->
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center px-4 mt-10">
        <div class="w-full max-w-md p-8 bg-gray-800 rounded-2xl shadow-2xl">
            <h2 class="text-3xl font-bold text-center mb-6 text-yellow-400">🎬 Rejoins CinéHall</h2>

            <form id="registerForm" class="space-y-4">
                <input
                    type="text"
                    name="name"
                    placeholder="Nom"
                    required
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <input
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    required
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

                <button
                    type="submit"
                    class="w-full py-2 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold rounded-lg transition duration-300">
                    🎟️ S'inscrire
                </button>
            </form>

            <div id="responseMessage" class="mt-4 text-center text-sm text-red-400"></div>
        </div>
    </main>

    <script>
        const form = document.getElementById('registerForm');
        const responseDiv = document.getElementById('responseMessage');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                password: formData.get('password')
            };

            try {
                const response = await fetch('http://localhost:8000/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    responseDiv.innerHTML = `✅ ${result.message} <br> Token: ${result.token}`;
                    // tu peux stocker le token dans localStorage si besoin :
                    localStorage.setItem('token', result.token);
                } else {
                    responseDiv.innerHTML = `❌ Erreur: ${result.message || 'Inscription échouée'}`;
                }

            } catch (error) {
                console.error(error);
                responseDiv.innerHTML = '❌ Une erreur est survenue.';
            }
        });
    </script>
</body>

</html>