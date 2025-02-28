<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BackgroundDots extends Component
{
    /**
     * Creo una nueva instancia del componente.
     */
    public function __construct()
    {
        //
    }

    /**
     * Obtengo la vista o contenido que representa el componente.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.background-dots');
    }
}
