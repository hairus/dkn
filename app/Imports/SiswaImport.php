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

            return back()->with('message', 'PASTIKAN JUDUL KOLOM (BARIS PERTAMA) TELAH DIHAPUS');
        }

        foreach ($rows as $row) {
            // pengecekan apakah dari sma asal
            $sma = true;

            if ($sma) {
                // jika data siswa itu ada
                $siswa = siswaFix::where([

                    'npsn_sma' => auth()->user()->npsn,

                    'nisn' => trim($row[1])

                ])->count();

                //jika nilai di atas seratus atau bukan numerik
                
                $cek_numerik=is_numeric($row[6]);

                if($row[6] > 100 || $row[6] < 0 || $cek_numerik === false){
                    
                    $nama = strtoupper(trim($row[0]));
                    
                    siswaFix::where('npsn_sma', auth()->user()->npsn)->delete();

                    return back()->with('message', 'Rentang nilai dari '.$nama.' salah');
                }

                //jika nisn excel kosong
                // delete data

                if ($row[1] == '' || $row[1] == null || strlen($row[1]) <> 10) {

                    $nama = strtoupper(trim($row[0]));

                    siswaFix::where('npsn_sma', auth()->user()->npsn)->delete();

                    return back()->with('message', 'NISN dari '.$nama.' salah');
                }

                //jika npsn smp excel kosong
                // delete data

                if ($row[5] == '' || $row[5] == null || strlen($row[5]) <> 8) {

                    $nama = strtoupper(trim($row[0]));

                    siswaFix::where('npsn_sma', auth()->user()->npsn)->delete();

                    return back()->with('message', 'NPSN SMP dari '.$nama.' salah');
                }

                if ($siswa > 0) {
                    // jika ada maka di delete
                    $datas = siswaFix::where([
                        'npsn_sma' => auth()->user()->npsn,

                        'nisn' => trim($row[1]),

                        'nama' => strtoupper(trim($row[0]))

                    ])->count();

                    if($datas){
                        siswaFix::where('npsn_sma', auth()->user()->npsn)->delete();

                        return back()->with('message', 'Terdeteksi ada siswa kembar (Nama dan NISN identik)');
                    }

                    // lalu insert

                    siswaFix::create([

                        'nama' => strtoupper(trim($row[0])),

                        'npsn_sma' => auth()->user()->npsn,

                        'nisn' => trim($row[1]),

                        'tingkat' => ucwords(strtolower(trim($row[2]))),

                        'npsn_smp' => trim($row[5]),

                        'rombel' => $row[3],

                    ])->nilai()->create([
                        'npsn_sma' => auth()->user()->npsn,

                        'npsn_smp' => trim($row[5]),

                        'rerata' => $row[6],
                    ]);
                } else {

                    // jika tidak ada data npsn dan nisn yang sama
                    siswaFix::create([

                        'nama' => strtoupper(trim($row[0])),

                        'npsn_sma' => auth()->user()->npsn,

                        'nisn' => trim($row[1]),

                        'tingkat' => ucwords(strtolower(trim($row[2]))),

                        'npsn_smp' => trim($row[5]),

                        'rombel' => $row[3],

                    ])->nilai()->create([
                        'npsn_sma' => auth()->user()->npsn,

                        'npsn_smp' => trim($row[5]),

                        'rerata' => $row[6],
                    ]);
                }
            } else {
                return back()->with('message', 'silakan cek kembali kelengkapan siswa seperti nisn, npsn masih kosong');
            }
        }
    }
}
