<?php

namespace App\Http\Controllers;

use App\Models\kab_kota;
use App\Models\siswa;
use App\Models\sma_smk_lengkap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $sekolahs = sma_smk_lengkap::get();
        $siswas = siswa::all();
        $kabs = kab_kota::all();
        return view('home', compact('sekolahs', 'siswas', 'kabs'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
