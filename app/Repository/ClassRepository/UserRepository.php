<?php

namespace App\Repository\ClassRepository;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repository\Interface\UserInterface;

class UserRepository implements UserInterface
{
    public function All()
    {
        return User::all();
    }

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Generate a JWT token for the user
        $token = Auth::guard('api')->login($user);

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'token' => $token
        ], 201);
    }

    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Identifiants incorrects'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    public function updateProfile(array $data)
    {
        // Récupérer l'utilisateur connecté via le token JWT
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        // Mise à jour uniquement des champs fournis
        if (!empty($data['name'])) {
            $user->name = $data['name'];
        }
        if (!empty($data['email'])) {
            $user->email = $data['email'];
        }
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();
        return $user;
    }
}
