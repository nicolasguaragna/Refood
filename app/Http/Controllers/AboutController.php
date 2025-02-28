<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Muestro la vista de la página "Acerca de Nosotros".
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }
}
