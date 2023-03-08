<?php

namespace App\Http\Controllers;

use App\Models\dataPokok;
use App\Models\kab_kota;
use App\Models\sma_smk_lengkap;
use App\Models\User;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public $timeout = 0;
    public function genUsers()
    {
        set_time_limit(400);
        $sma = sma_smk_lengkap::all();

        $jum = $sma->count();

        foreach ($sma as $data) {
            $password_dummy = Str::random(8);
            $user = User::where('npsn', $data->npsn)->delete();
            $user = User::create([
                'name' => $data->nm_sekolah,
                'email' => fake()->unique()->safeEmail(),
                'password_real' => $password_dummy,
                'password' => bcrypt($password_dummy),
                'npsn' => $data->npsn,
            ])->roles()->create([
                'role' => 2
            ]);
        }
        return back();
    }

    public function getuser()
    {
        $user = User::all();

        return view('admin.users.index', compact('user'));
    }

    public function unlock()
    {
        return view('admin.unlock.index');
    }

    public function monitoring()
    {
        //$kabs = kab_kota::with(['sekolahs' => function($q){$q->with('siswafix');}])->limit(10)->get();

        $kabs = kab_kota::all();

        $gg = [];
        foreach($kabs as $data){
            $gg[$data->id] = DB::table('data_pokoks')
            ->leftjoin('sma_smk_lengkaps', 'data_pokoks.npsn_sekolah', '=', 'sma_smk_lengkaps.npsn')// joining the contacts table , where user_id and contact_user_id are same
            ->where('sma_smk_lengkaps.kab_kota', $data->id)
            ->count();
        }

        $gg1 = [];
        foreach($kabs as $data){
            $gg1[$data->id] = DB::table('siswa_fixes')
            ->leftjoin('sma_smk_lengkaps', 'siswa_fixes.npsn_sma', '=', 'sma_smk_lengkaps.npsn')// joining the contacts table , where user_id and contact_user_id are same
            ->where('sma_smk_lengkaps.kab_kota', trim($data->id))
            ->count();
        }

        $gg2 = [];
        for($i=1;$i<=38;$i++){
            $gg2[$i] = DB::table('sma_smk_lengkaps')
            ->where('kab_kota',$i)
            ->count();
        }

        return view('admin.monitoring.index',compact('kabs', 'gg', 'gg1', 'gg2'));
    }

    public function showMon()
    {
        $smas = sma_smk_lengkap::with('siswafix')->get();

        return view('admin.monitoring.show');
    }

    public function showDet($id)
    {
        $smas = sma_smk_lengkap::with('user')->where('kab_kota', $id)->orderBy('kode_un')->get();

        $gg = [];
        foreach($smas as $data){
            $gg[$data->npsn] = DB::table('data_pokoks')
            ->leftjoin('sma_smk_lengkaps', 'data_pokoks.npsn_sekolah', '=', 'sma_smk_lengkaps.npsn')// joining the contacts table , where user_id and contact_user_id are same
            ->where('sma_smk_lengkaps.npsn', $data->npsn)
            ->count();
        }

        $gg1 = [];
        foreach($smas as $data){
            $gg1[$data->npsn] = DB::table('siswa_fixes')
            ->leftjoin('sma_smk_lengkaps', 'siswa_fixes.npsn_sma', '=', 'sma_smk_lengkaps.npsn')// joining the contacts table , where user_id and contact_user_id are same
            ->where('sma_smk_lengkaps.npsn', $data->npsn)
            ->count();
        }

        return view('admin.monitoring.detail', compact('gg', 'gg1', 'smas'));
    }


}
