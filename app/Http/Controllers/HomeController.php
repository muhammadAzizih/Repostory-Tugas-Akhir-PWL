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
        $user = auth()->user();

        if ($user->isMahasiswa()) {
            return redirect()->route('mahasiswa.dashboard');
        } elseif ($user->isOperator()) {
            return redirect()->route('operator.dashboard');
        } elseif ($user->isKaprodi()) {
            return redirect()->route('kaprodi.dashboard');
        }

        return view('home');
    }
}
