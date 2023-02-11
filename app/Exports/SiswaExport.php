<?php

namespace App\Exports;

use App\Models\dataPokok;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return dataPokok::where('npsn_sekolah', Auth::user()->npsn)->get();
    }

    public function map($row): array
    {

        return [
            $row->nama, // attendance id // attendance status
            $row->npsn_sekolah, // attendance id // attendance status
            $row->nisn, // attendance belongs to user
            $row->tingkat, // attendance belongs to user
            $row->asal_sekolah, // attendance belongs to usser
        ];
    }

    public function headings(): array
    {
        return ["nama", "npsn_sekolah", 'nisn', 'tingkat', 'asal_sekolah', 'npsn_smp','rerata nilai'];
    }
}
