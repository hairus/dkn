<?php

namespace App\Http\Controllers;

use App\Models\dataPokok;
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
            $model = siswaFix::where(function ($query) use ($sma) {
                $query->where('npsn_sma', $sma->npsn);
            });

            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('action', function($query){
                    return '<button class="btn btn-primary btn-sm" onclick="edit('.$query->id.')">Edit</button>';
                })
                ->toJson();
        } else {
            $model = dataPokok::where(function ($query) use ($sma) {
                $query->where('npsn_sekolah', $sma->npsn);
            });

            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('action', function($query){
                    return '<button class="btn btn-primary btn-sm" onclick="edit('.$query->id.')">Edit</button>';
                })
                ->toJson();
        }
    }
}
