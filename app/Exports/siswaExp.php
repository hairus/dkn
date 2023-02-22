<?php

namespace App\Exports;

use App\Models\dataPokok;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class siswaExp implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return dataPokok::where('npsn_sekolah', Auth::user()->npsn)->orderBy('tingkat', 'ASC')->orderBy('rombel', 'ASC')->orderBy('nama', 'ASC')->get();
    }

    public function map($row): array
    {

        return [
            $row->nama, // attendance id // attendance status
            $row->nisn, // attendance belongs to user
            $row->tingkat, // attendance belongs to user
            $row->rombel, // attendance belongs to user
        ];
    }

    public function headings(): array
    {
        return ["nama", 'nisn', 'tingkat','rombel'];
    }
}
