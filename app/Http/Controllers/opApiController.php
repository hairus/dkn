<?php

namespace App\Http\Controllers;

use App\Models\dataPokok;
use App\Models\nilai_siswa;
use App\Models\siswaFix;
use App\Models\sma_smk_lengkap;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class opApiController extends Controller
{
    public function getSiswa()
    {
        $sma = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();

        //cek jika ada siswafix
        $cek = siswaFix::where('npsn_sma', auth()->user()->npsn)->count();

        if ($cek > 0) {
            $model = dataPokok::where(function ($query) use ($sma) {
                    $query->where('npsn_sekolah', $sma->npsn);
                });

            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('action', function ($query) {
                    return '<button disabled class="btn btn-sm text-white rounded-pill bg-primary" onclick="edit(' . $query->id . ')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button disabled class="btn btn-sm text-white rounded-pill bg-danger" onclick="destroy(' . $query->id . ')">
                    <i class="fas fa-trash"></i>
                </button>';
                })
                ->toJson();
        } else {
            if (auth()->user()->fds->final == true) {
                $model = dataPokok::where(function ($query) use ($sma) {
                    $query->where('npsn_sekolah', $sma->npsn);
                });

                return DataTables::eloquent($model)
                    ->addIndexColumn()
                    ->addColumn('action', function ($query) {
                        return '<button disabled class="btn btn-sm text-white rounded-pill bg-primary" onclick="edit(' . $query->id . ')">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button disabled class="btn btn-sm text-white rounded-pill bg-danger" onclick="destroy(' . $query->id . ')">
                        <i class="fas fa-trash"></i>
                    </button>';
                    })
                    ->toJson();
            } else {
                $model = dataPokok::where(function ($query) use ($sma) {
                    $query->where('npsn_sekolah', $sma->npsn);
                });

                return DataTables::eloquent($model)
                    ->addIndexColumn()
                    ->addColumn('action', function ($query) {
                        return '<button class="btn btn-sm text-white rounded-pill bg-primary" onclick="edit(' . $query->id . ')">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-sm text-white rounded-pill bg-danger" onclick="destroy(' . $query->id . ')">
                        <i class="fas fa-trash"></i>
                    </button>';
                    })
                    ->toJson();
            }
        }
    }

    public function getNilai()
    {
        $smas = nilai_siswa::with('siswas')->where('npsn_sma', auth()->user()->npsn);

        return DataTables::eloquent($smas)
            ->addIndexColumn()
            ->addColumn('nama', function(nilai_siswa $nilai){
                $nama = $nilai->siswas->nama;
                return $nama;
            })
            ->addColumn('tingkat', function(nilai_siswa $nilai){
                $tingkat = $nilai->siswas->tingkat;
                return $tingkat;
            })
            ->addColumn('rombel', function(nilai_siswa $nilai){
                $rombel = $nilai->siswas->rombel;
                return $rombel;
            })
            ->addColumn('nisn', function(nilai_siswa $nilai){
                $nisn = $nilai->siswas->nisn;
                return $nisn;
            })
            ->toJson();
    }
}
