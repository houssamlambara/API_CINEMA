<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion - CinéHall</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white font-sans min-h-screen flex flex-col">

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

    <!-- Formulaire de Connexion -->
    <main class="flex-grow flex items-center justify-center px-4 mt-10">
        <div class="w-full max-w-md p-8 bg-gray-800 rounded-2xl shadow-2xl">
            <h2 class="text-3xl font-bold text-center mb-6 text-yellow-400">🎬 Connexion à CinéHall</h2>

            <form id="loginForm" class="space-y-4">
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
                    🎟️ Se connecter
                </button>
            </form>

            <div id="responseMessage" class="mt-4 text-center text-sm"></div>
        </div>
    </main>

    <!-- JS Connexion -->
    <script>
        const form = document.getElementById('loginForm');
        const responseDiv = document.getElementById('responseMessage');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const credentials = {
                email: formData.get('email'),
                password: formData.get('password')
            };

            try {
                const response = await fetch('http://localhost:8000/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(credentials)
                });

                const result = await response.json();

                if (response.ok) {
                    responseDiv.className = 'mt-4 text-center text-sm text-green-400';
                    responseDiv.innerHTML = `✅ Connexion réussie !`;
                    localStorage.setItem('token', result.token);

                    // Redirection vers une page sécurisée
                    // window.location.href = '/dashboard.html';
                } else {
                    responseDiv.className = 'mt-4 text-center text-sm text-red-400';
                    responseDiv.innerHTML = `❌ ${result.error || 'Identifiants incorrects.'}`;
                }

            } catch (error) {
                responseDiv.className = 'mt-4 text-center text-sm text-red-400';
                responseDiv.innerHTML = '❌ Une erreur réseau est survenue.';
            }
        });
    </script>

</body>

</html>
