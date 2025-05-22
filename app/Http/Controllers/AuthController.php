<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
       
        return view('auth.login');
    }
    public function dologin(Request $request)
    {
        // validate
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3', 'max:255']
        ]);
        // try to login
        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->intended(route('admin.property.index'));
        } else {
            return back()->withErrors([
                'failed' => 'Your email or password is incorrect.',            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
   return to_route('login')->with('success', 'You are logged out');
    }
    public function register()
    {
        return view('auth.Register');
    }
    public function doRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3', ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('admin.property.index')->with('success', 'Inscription réussie !');
    }
}
