<?php

namespace App\Http\Controllers;

use DB;
use App\Exports\siswaExp;
use App\Exports\SiswaExport;
use App\Exports\SiswaExport1;
use App\Exports\SmpExport;
use App\Imports\SiswaImport;
use App\Models\dataPokok;
use App\Models\final_nilai;
use App\Models\final_siswa;
use App\Models\kab_kota;
use App\Models\mst_smp;
use App\Models\nilai_siswa;
use App\Models\siswaFix;
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
        if (auth()->user()->fns->final == false) {
            return view('operator.siswa.import');
        }else{
            return back();
        }
    }

    public function saveImport(Request $request)
    {

        $file = $request->file('file')->store('temp');

        Excel::import(new SiswaImport, $request->file('file')->store('temp'));

        return redirect('op/siswaNilai');
    }

    public function siswaNilai()
    {
        $fns = final_siswa::where('user_id', auth()->user()->id)->first();
        if ($fns->final == false) {
            return redirect('/op/finalisasi');
        } else {
            //$smas = nilai_siswa::with('siswas')->where('npsn_sma', auth()->user()->npsn)->get()->sortByDesc('siswas.nama')->sortBy('siswas.rombel');
            //anas
            $smas = DB::table('siswa_fixes')
            ->leftjoin('nilai_siswas', 'nilai_siswas.siswa_id', '=', 'siswa_fixes.id')// joining the contacts table , where user_id and contact_user_id are same
            ->leftjoin('mst_smps', 'siswa_fixes.npsn_smp', '=', 'mst_smps.npsn_smp')// joining the contacts table , where user_id and contact_user_id are same
            ->select('siswa_fixes.*', 'nilai_siswas.rerata', 'mst_smps.nama_smp')
            ->where('siswa_fixes.npsn_sma', auth()->user()->npsn)
            ->orderby('siswa_fixes.tingkat', 'asc')
            ->orderby('siswa_fixes.rombel', 'asc')
            ->orderby('siswa_fixes.nama', 'asc')
            ->get();
            $sma = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();
            
            //return view('operator.siswa.showNilai', compact('sma', 'smas'));
            //anas
            return view('operator.siswa.showNilai222', compact('sma', 'smas'));
        }
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

    public function getsiswa($id)
    {
        $data_pokok = dataPokok::find($id);

        return view('operator.siswa.siswaedit', compact('data_pokok'));
    }

    public function storenisn(Request $request)
    {

        $siswas = dataPokok::find($request->id);
        $siswas->nisn = $request->nisn;
        $siswas->rombel = $request->rombel;
        $siswas->save();
    }

    public function add(Request $request)
    {
        // dd(auth()->user()->sma->nm_sekolah);
        // dd($request);
        $add = dataPokok::create([
            "nama" => $request->nama,
            'tingkat' => $request->tingkat,
            'npsn_sekolah' => auth()->user()->npsn,
            'nama_sekolah' => auth()->user()->sma->nm_sekolah,
            'rombel' => $request->rombel,
            'asal_sekolah' => "-",
            'nisn' => $request->nisn,
        ]);
    }

    public function destroy($id)
    {
        $dataPokok = dataPokok::find($id);
        $dataPokok->delete();
    }

    public function delSis()
    {
        // titip dns
        /**
         * ns.beonintermedia.com

         *ns.jagoanhosting.com

         *ns.jagoanweb.com


         */
        $true = auth()->user()->fns->final;

        if ($true == false) {
            $sisfix = siswaFix::where('npsn_sma', auth()->user()->npsn)->delete();

            return back()->with('message', 'hapus siswa berhasil');
        } else {

            return back()->with('message', 'Maaf fitur sudah terkunci');
        }
    }

    public function finalisasi()
    {
        $sma = sma_smk_lengkap::where('npsn', auth()->user()->npsn)->first();
        $fds = final_siswa::where('user_id', auth()->user()->id)->first();
        $fns = final_nilai::where('user_id', auth()->user()->id)->first();

        return view('operator.op.finalisasi', compact('sma', 'fds', 'fns'));
    }

    public function agree(Request $request)
    {
        if ($request->agree == 1) {
            $user = User::find(auth()->user()->id);
            $user->update([
                'edit_status' => 0
            ]);
        }

        return back();
    }

    public function fds()
    {
        //cek dulu ada tidak di database
        $cek = auth()->user()->fds();

        //jika tidak ada maka create
        if ($cek->count() == 0 || $cek->count() == "") {
            $user = auth()->user()->fds()->create([
                "final" => true
            ]);
        } else {
            //jika ada maka cek perubahan karena defaultnya false

            $user = auth()->user()->fds()->update([
                "final" => true
            ]);
        }
    }

    public function fns()
    {
        //cek dulu ada tidak di database
        $cek = auth()->user()->fns();

        //jika tidak ada maka create
        if ($cek->count() == 0 || $cek->count() == "") {
            $user = auth()->user()->fns()->create([
                "final" => true
            ]);
        } else {
            //jika ada maka cek perubahan karena defaultnya false

            $user = auth()->user()->fns()->update([
                "final" => true
            ]);
        }
    }

    public function genNilai()
    {
        $user = User::all();
        foreach ($user as $data) {
            $data->fds()->create([
                "final" => false
            ]);
            $data->fns()->create([
                "final" => false
            ]);
        }
    }

    public function export2()
    {
        return Excel::download(new siswaExp, 'siswa.xlsx');
    }
}
