<?php

namespace App\Http\Controllers;

use App\Models\dataPokok;
use App\Models\final_nilai;
use App\Models\final_siswa;
use App\Models\kab_kota;
use App\Models\siswa;
use App\Models\siswaFix;
use App\Models\sma_smk_lengkap;
use App\Models\User;
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

                $siswa1s = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->get();
                $siswa2s = siswaFix::where('npsn_sma', auth()->user()->npsn)->get();

                //return view('home', compact('siswas', 'sekolah'));
                return view('home', compact('siswa1s', 'siswa2s', 'sekolah'));
            } else {

                $sekolah = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();

                $siswas = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->get();

                $siswa1s = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->get();
                $siswa2s = siswaFix::where('npsn_sma', auth()->user()->npsn)->get();

                //return view('home', compact('siswas', 'sekolah'));
                return view('home', compact('siswa1s', 'siswa2s', 'sekolah'));
            }
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index2()
    {
        if (auth()->user()->roles->role == 1) {
            $sekolahs = sma_smk_lengkap::get();

            $siswas = siswaFix::count();
            $dp = dataPokok::count();

            $kabs = kab_kota::all();

            //$siswa1s = dataPokok::all()->paginate(20)->count();
            // $siswa2s = siswaFix::limit(10)->get()->count();
            //dd($siswa2s);

            return view('home222', compact('sekolahs', 'siswas', 'kabs', 'dp'));

        } else {
            $sekolah = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();

            $siswas = siswaFix::where('npsn_sma', auth()->user()->npsn)->get();

            $siswa1s = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->get();
            $siswa1s_10 = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->where('tingkat', 'Kelas 10')->get();
            $siswa1s_11 = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->where('tingkat', 'Kelas 11')->get();
            $siswa1s_12 = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->where('tingkat', 'Kelas 12')->get();

            $siswa2s = siswaFix::where('npsn_sma', auth()->user()->npsn)->get();
            $siswa2s_10 = siswaFix::where('npsn_sma', auth()->user()->npsn)->where('tingkat', 'Kelas 10')->get();
            $siswa2s_11 = siswaFix::where('npsn_sma', auth()->user()->npsn)->where('tingkat', 'Kelas 11')->get();
            $siswa2s_12 = siswaFix::where('npsn_sma', auth()->user()->npsn)->where('tingkat', 'Kelas 12')->get();


            $fds = final_siswa::where('user_id', auth()->user()->id)->first();
            $fns = final_nilai::where('user_id', auth()->user()->id)->first();

            //return view('home', compact('siswas', 'sekolah'));
            return view('home222', compact('siswa1s', 'siswa1s_10', 'siswa1s_11', 'siswa1s_12', 'siswa2s', 'siswa2s_10', 'siswa2s_11', 'siswa2s_12', 'sekolah', 'fds', 'fns'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
