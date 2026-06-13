<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil nama user yang login
        $userName = Auth::user()->name;
        $userType = Auth::user()->usertype;

        // Kirim ke view
        return view('dashboard', compact('userName', 'userType'));
    }
}

