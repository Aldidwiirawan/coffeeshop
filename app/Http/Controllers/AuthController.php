<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if (in_array($user->usertype, ['admin', 'owner'])) {
                return redirect()->route('dashboard'); // Redirect ke dashboard
            } else {
                return redirect()->route('welcome'); // Redirect customer ke home
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user(); // Ambil data user sebelum logout

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user && in_array($user->usertype, ['admin', 'owner'])) {
            return redirect()->route('login'); // Admin & Owner kembali ke login
        } else {
            return redirect()->route('welcome'); // Customer kembali ke halaman awal
        }
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user sebagai customer
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usertype' => 'customer', // Default usertype untuk customer
        ]);

        // Auto-login setelah registrasi
        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }


}
