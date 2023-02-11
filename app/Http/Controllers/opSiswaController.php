<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Exports\SmpExport;
use App\Models\kab_kota;
use App\Models\mst_smp;
use App\Models\sma_smk_lengkap;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class opSiswaController extends Controller
{
    public function siswas()
    {
        $sekolah = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();

        return view('operator.siswa.siswa', compact('sekolah'));
    }

    public function export()
    {
        return Excel::download(new SiswaExport, 'users.xlsx');
    }

    public function exportsmp()
    {
        $kab = kab_kota::all();
        return Excel::download(new SmpExport($kab), 'smp.xlsx');
    }
}
