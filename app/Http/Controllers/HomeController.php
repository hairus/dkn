<?php

namespace App\Http\Controllers;

use App\Models\dataPokok;
use App\Models\kab_kota;
use App\Models\siswa;
use App\Models\siswaFix;
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
        if (auth()->user()->roles->role == 1) {
            $sekolahs = sma_smk_lengkap::get();

            $siswas = siswa::all();

            $kabs = kab_kota::all();

            return view('home', compact('sekolahs', 'siswas', 'kabs'));

        } else {
            $cek = siswaFix::where('npsn_sma', auth()->user()->npsn)->count();
            if ($cek > 0) {

                $sekolah = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();

                $siswas = siswaFix::where('npsn_sma', auth()->user()->npsn)->get();

                return view('home', compact('siswas', 'sekolah'));
            } else {

                $sekolah = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();

                $siswas = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->get();

                return view('home', compact('siswas', 'sekolah'));
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
