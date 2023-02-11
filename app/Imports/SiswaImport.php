<?php

namespace App\Imports;

use App\Models\siswa;
use App\Models\siswaFix;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // cek dulu apakah di dalam data base ada npsn dan nisn yang sama
            $siswa = siswaFix::where([

                'npsn_sma' => $row[1],

                'nisn' => $row[2]

            ])->count();

            if ($siswa > 0) {
                // jika ada maka di delete
                $datas = siswaFix::where([
                    'npsn_sma' => $row[1],

                    'nisn' => $row[2]

                ])->delete();

                // lalu insert

                siswaFix::create([

                    'nama' => $row[0],

                    'npsn_sma' => $row[1],

                    'nisn' => $row[2],

                    'tingkat' => $row[3],

                    'npsn_smp' => $row[5],

                    'rombel' => 'rombel',

                ])->nilai()->create([
                    'npsn_sma' => $row[1],

                    'npsn_smp' => $row[5],

                    'rerata' => $row[6],
                ]);
            } else {
                // jika tidak ada data npsn dan nisn yang sama
                siswaFix::create([

                    'nama' => $row[0],

                    'npsn_sma' => $row[1],

                    'nisn' => $row[2],

                    'tingkat' => $row[3],

                    'npsn_smp' => $row[5],

                    'rombel' => 'rombel',
                ])->nilai()->create([
                    'npsn_sma' => $row[1],

                    'npsn_smp' => $row[5],

                    'rerata' => $row[6],
                ]);
            }
        }
    }
}
