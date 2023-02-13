<?php

namespace App\Imports;

use App\Models\dataPokok;
use App\Models\siswa;
use App\Models\siswaFix;
use Hamcrest\Type\IsInteger;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;


class SiswaImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        //cek jumlah siswa

        $jumDataPokok = dataPokok::where('npsn_sekolah', auth()->user()->npsn)->count();
        $jumlah_excel = $rows->count();

        if ($jumDataPokok != $jumlah_excel) {
            siswaFix::where('npsn_sma', auth()->user()->npsn)->delete();

            return back()->with('message', 'FORMAT EXCEL TIDAK COCOK');;
        }

        foreach ($rows as $row) {
            // pengecekan apakah dari sma asal
            $sma = true;

            if ($sma) {
                // jika data siswa itu ada
                $siswa = siswaFix::where([

                    'npsn_sma' => auth()->user()->npsn,

                    'nisn' => $row[2]

                ])->count();

                //jika nilai di atas seratus
                if($row[7] > 100 || $row[7] < 0){
                    siswaFix::where('npsn_sma', auth()->user()->npsn)->delete();

                    return back()->with('message', 'rentang nilai salah');
                }

                //jika nisn excel kosong
                // delete data

                if ($row[2] == '' || $row[2] == null) {

                    siswaFix::where('npsn_sma', auth()->user()->npsn)->delete();

                    return back()->with('message', 'nisn siswa ada yang kosong');;
                }


                if ($siswa > 0) {
                    // jika ada maka di delete
                    $datas = siswaFix::where([
                        'npsn_sma' => auth()->user()->npsn,

                        'nisn' => $row[2]

                    ])->delete();

                    // lalu insert

                    siswaFix::create([

                        'nama' => $row[0],

                        'npsn_sma' => auth()->user()->npsn,

                        'nisn' => $row[2],

                        'tingkat' => $row[3],

                        'npsn_smp' => $row[6],

                        'rombel' => $row[4],

                    ])->nilai()->create([
                        'npsn_sma' => auth()->user()->npsn,

                        'npsn_smp' => $row[6],

                        'rerata' => $row[7],
                    ]);
                } else {

                    // jika tidak ada data npsn dan nisn yang sama
                    siswaFix::create([

                        'nama' => $row[0],

                        'npsn_sma' => auth()->user()->npsn,

                        'nisn' => $row[2],

                        'tingkat' => $row[3],

                        'npsn_smp' => $row[6],

                        'rombel' => $row[4],

                    ])->nilai()->create([
                        'npsn_sma' => auth()->user()->npsn,

                        'npsn_smp' => $row[6],

                        'rerata' => $row[7],
                    ]);
                }
            } else {
                return back()->with('message', 'silakan cek kembali kelengkapan siswa seperti nisn, npsn masih kosong');
            }
        }
    }
}
