<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'required|min:3'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            // $token = $user->createToken('authToken')->plainTextToken;
            // return response()->json(['token' => 'Email ou mot de passe incorrect'], 401);
        }
        return back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Déconnexion réussie'], 200);
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
    public function update(Request $request, string $id) // PUT
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //DELETE
    {
        //
    }
}
