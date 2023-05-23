<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login')
            ->with('title', 'CRUD Impact | Login')
            ->with('menu', 'login');
    }
    public function login()
    {
        $credentials = request()->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            session()->flash('msg', "Welcome Back!");
            return redirect()->intended('/');
        }
        return back()->with('msg', "Login Failed");
    }
    public function create()
    {
        return view('auth.register')
            ->with('title', 'CRUD Impact | Register')
            ->with('menu', 'register');
    }
    public function store()
    {
        $validateData = request()->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);
        return redirect()->route('auth.index')->with('succ', "Sign Up Success! Please Login");
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
