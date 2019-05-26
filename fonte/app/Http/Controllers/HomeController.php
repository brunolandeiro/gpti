<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function perfil()
    {
        return view('perfil');
    }

    public function backup()
    {
        return view('danied');
    }

    public function help()
    {
        return view('help');
    }

    public function auditoria()
    {
        return view('danied');
    }
}
