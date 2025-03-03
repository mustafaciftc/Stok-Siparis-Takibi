<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stoklar = Stok::all(); 
        return view('home', compact('stoklar')); 
    }
}