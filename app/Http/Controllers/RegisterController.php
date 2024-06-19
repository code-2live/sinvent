<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|min:3|max:255'
        ]);

        User::create($validData);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
