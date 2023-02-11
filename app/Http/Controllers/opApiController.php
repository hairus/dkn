<?php

namespace App\Http\Controllers;

use App\Models\dataPokok;
use App\Models\sma_smk_lengkap;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class opApiController extends Controller
{
    public function getSiswa()
    {
        $sma = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();

        $model = dataPokok::where(function ($query) use ($sma){
            $query->where('npsn_sekolah', $sma->npsn);
        });

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->make(true);
    }
}
