<?php

namespace App\Http\Controllers;

use App\Models\sma_smk_lengkap;
use App\Models\User;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public $timeout = 0;
    public function genUsers()
    {
        set_time_limit(300);
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


}
