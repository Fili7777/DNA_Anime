<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request, UserRepository $userRepository)
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = $userRepository->create($validated);
        Auth::login($user, true);
        return redirect()->route('welcome');
    }
    public function showRegisterForm()
    {
        return view('auth.register');

    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if(!Auth::attempt($validated, true)){
            return back()->withErrors("Credenziali non valide");
        }
        return redirect()->route('welcome');

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
