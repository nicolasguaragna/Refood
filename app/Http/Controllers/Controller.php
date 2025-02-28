<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Habilita la autorización y validación en todos los controladores que hereden de esta clase.
     */
    use AuthorizesRequests, ValidatesRequests;
}
