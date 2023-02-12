<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Exports\SmpExport;
use App\Imports\SiswaImport;
use App\Models\kab_kota;
use App\Models\mst_smp;
use App\Models\nilai_siswa;
use App\Models\sma_smk_lengkap;
use App\Models\User;
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
        return Excel::download(new SiswaExport, 'pesertaDidik.xlsx');
    }

    public function exportsmp()
    {
        $kab = kab_kota::all();

        return Excel::download(new SmpExport($kab), 'smp.xlsx');
    }

    public function import()
    {
        return view('operator.siswa.import');
    }

    public function saveImport(Request $request)
    {

        $file = $request->file('file')->store('temp');

        Excel::import(new SiswaImport, $request->file('file')->store('temp'));

        return redirect('op/siswaNilai');
    }

    public function siswaNilai()
    {
        $smas = nilai_siswa::where('npsn_sma', auth()->user()->npsn)->get();
        $sma = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();

        return view('operator.siswa.showNilai', compact('sma', 'smas'));
    }

    public function changePass()
    {
        $sma = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();
        return view('operator.op.changePass', compact('sma'));
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'password' => bcrypt($request->password),
            'password_real' => $request->password
        ]);

        return back()->with('success', 'password sudah di rubah');
    }
}
