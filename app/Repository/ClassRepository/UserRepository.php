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
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Déconnexion réussie']);
    }
    public function update(array $date)
    {
       
    }
}
