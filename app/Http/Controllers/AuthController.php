<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:3'
        ]);

        return $this->service->register($data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        try {
            // générer le token JWT
            if ($token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['token' => $token]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            auth()->logout(); 
            return response()->json(['message' => 'Déconnexion réussie']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erreur lors de la déconnexion'], 500);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id) //GET
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . Auth::id(),
                'password' => 'nullable|string|min:3'
            ]);

            $user = $this->service->updateProfile($data);

            return response()->json([
                'message' => 'Profil mis à jour avec succès',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour du profil'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) 
    {
        //
    }
}
