<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(AuthRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Данные не верны!'
            ]);
        }

        return redirect()->route('articles.index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        User::query()->create([
            'name' => $request->get('email'),
            'email'    => $request->get('email'),
            'password' => Hash::make(($request->get('password')))
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
