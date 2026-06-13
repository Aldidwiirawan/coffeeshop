<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        return view('customer.menu.catalog'); // Pastikan file view catalog.blade.php ada di resources/views
    }
}

