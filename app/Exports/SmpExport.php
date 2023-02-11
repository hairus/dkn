<?php

namespace App\Exports;

use App\Models\kab_kota;
use App\Models\mst_smp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SmpExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return mst_smp::select('npsn_smp', 'nama_smp', 'kab_id', 'jenjang')->get();
    }

    public function map($row): array
    {

        return [
            $row->npsn_smp, // attendance id // attendance status
            $row->nama_smp, // attendance id // attendance status
            $row->kabs->kab_kota, // attendance belongs to user
            $row->jenjang, // attendance belongs to user
        ];
    }

    public function headings(): array
    {
        return ["npsn", "nama smp", 'kab/kota', 'jenjang'];
    }
}
