<?php

namespace App\Http\Controllers;

use App\Models\kab_kota;
use App\Models\sma_smk_lengkap;
use Illuminate\Http\Request;

class sekolahController extends Controller
{
    public function index()
    {

        return view('admin.sekolah.allSekolah');
    }

    public function read()
    {
        $sekolahs = sma_smk_lengkap::with('siswas')->get();

        return view('admin.sekolah.read', compact('sekolahs'));
    }

    public function create()
    {
        $kabs = kab_kota::all();

        return view('admin.sekolah.create', compact('kabs'));
    }

    public function store(Request $request)
    {
        $sim = sma_smk_lengkap::create([
            'kode_un' => 121212,
            'npsn' => $request['npsn'],
            'nm_sekolah' => $request['nama'],
            'kab_kota' => $request['kab_kota'],
            'jenjang' => $request['jenjang'],
        ]);
    }

    public function destroy($id)
    {
        $sma = sma_smk_lengkap::find($id);
        $sma->delete();

    }

    public function edit($id)
    {
        $sma = sma_smk_lengkap::find($id);

        $kabs = kab_kota::all();

        return view('admin.sekolah.edit', compact('sma', 'kabs'));
    }

    public function update(Request $request)
    {
        $sma = sma_smk_lengkap::find($request->sma_id);
        $sma->update([
            'kode_un' => $sma->kode_un,
            'npsn' => $request['npsn'],
            'nm_sekolah' => $request['nama'],
            'kab_kota' => $request['kab_kota'],
            'jenjang' => $request['jenjang'],
        ]);
    }
}
