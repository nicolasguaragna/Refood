<?php
namespace App\Http\Controller;

class HomeController
{
    public function index()
    {
        return view('welcome');
    }
}