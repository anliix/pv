<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Método para la página principal después del login
    public function index()
    {
        return view('home.index'); // Asegúrate de tener esta vista
    }
}