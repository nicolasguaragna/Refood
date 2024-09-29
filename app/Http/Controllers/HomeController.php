<?php
namespace App\Http\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller 
{
    public function index()
    {
        return view('home');
    }
}