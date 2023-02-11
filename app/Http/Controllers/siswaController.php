<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\siswa;
use App\Models\siswaFix;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class siswaController extends Controller
{
    public function index()
    {
        return view('admin.siswa.siswas');
    }

    public function show()
    {
        $siswas = siswaFix::all();

        return view('admin.siswa.read', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa.add');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

        Excel::import(new SiswaImport, $name.'xlsx');
    }

    public function import()
    {
        return view('admin.siswa.import');
    }

    public function saveImport(Request $request)
    {
        $file = $request->file('file')->store('temp');

        Excel::import(new SiswaImport, $request->file('file')->store('temp'));

        return redirect('/admin/siswas');
    }
}
