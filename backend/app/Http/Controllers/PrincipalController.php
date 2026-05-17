<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index()
    {
        return view('public-pages.principal');
    }

    public function profesionales()
    {
        return view('public-pages.profesionales');
    }

    public function tecnologia(){
        return view ('public-pages.tecnologia');
    }
}