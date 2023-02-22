<?php

namespace App\Http\Controllers;

use App\Models\dataPokok;
use App\Models\final_nilai;
use App\Models\final_siswa;
use App\Models\sma_smk_lengkap;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApiAdminController extends Controller
{
    public function showSma()
    {
        $model = sma_smk_lengkap::query();

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '<button class="btn btn-sm text-white rounded-pill bg-primary" onclick="unlockds(' . $query->id . ')">
                <i class="fas fa-pencil-alt"></i> Unlock Data Siswa
            </button>
            <button class="btn btn-sm text-white rounded-pill bg-danger" onclick="unlockns(' . $query->id . ')">
                <i class="fas fa-pencil-alt"></i> Unlock Data Nilai
            </button>';
            })
            ->make(true);
    }

    public function unlockds($id)
    {
        $sma = sma_smk_lengkap::find($id);
        $user = User::where('npsn', $sma->npsn)->first();
        $fds = final_siswa::where('user_id', $user->id)->first();
        $fds->final = false;
        $fds->save();

        return $fds;
    }

    public function unlockns($id)
    {
        $sma = sma_smk_lengkap::find($id);
        $user = User::where('npsn', $sma->npsn)->first();
        $fds = final_nilai::where('user_id', $user->id)->first();
        $fds->final = false;
        $fds->save();

        return $fds;
    }
}
