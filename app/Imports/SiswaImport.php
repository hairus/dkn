<?php

namespace App\Imports;

use App\Models\siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // cek dulu apakah di dalam data base ada npsn dan nisn yang sama
            $siswa = siswa::where([

                'npsn' => $row[0],

                'nisn' => $row[1]

            ])->count();

            if ($siswa > 0) {
                // jika ada maka di delete
                $datas = siswa::where([
                    'npsn' => $row[0],

                    'nisn' => $row[1]

                ])->delete();

                // lalu insert

                siswa::create([

                    'npsn' => $row[0],

                    'nisn' => $row[1],

                    'nama' => $row[2],

                    'tingkat_kelas' => $row[3],

                    'rombel' => $row[4],

                    'npsn_smp' => $row[5],
                ])->nilai()->create([
                    'smt1' => $row[6],

                    'smt2' => $row[7],

                    'smt3' => $row[8],
                    'smt4' => $row[9],
                    'smt5' => $row[10],
                    'jum_smt' => $row[11],
                ]);
            } else {
                // jika tidak ada data npsn dan nisn yang sama
                siswa::create([

                    'npsn' => $row[0],

                    'nisn' => $row[1],

                    'nama' => $row[2],

                    'tingkat_kelas' => $row[3],

                    'rombel' => $row[4],

                    'npsn_smp' => $row[5],
                ])->nilai()->create([
                    'smt1' => $row[6],

                    'smt2' => $row[7],

                    'smt3' => $row[8],
                    'smt4' => $row[9],
                    'smt5' => $row[10],
                    'jum_smt' => $row[11],
                ]);
            }
        }
    }
}
