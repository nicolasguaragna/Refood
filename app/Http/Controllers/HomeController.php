<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Muestro la vista de la página principal.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}
