<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai_siswa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function siswas()
    {
        return $this->belongsTo(siswaFix::class, 'siswa_id');
    }

    public function smas()
    {
        return $this->belongsTo(sma_smk_lengkap::class, 'npsn_sma', 'npsn');
    }

    public function smps()
    {
        return $this->belongsTo(mst_smp::class, 'npsn_smp', 'npsn_smp');
    }
}
