<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswaFix extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function nilai()
    {
        return $this->hasOne(nilai_siswa::class, 'siswa_id');
    }

    public function sekolahs()
    {
        return $this->belongsTo(sma_smk_lengkap::class, 'npsn_sma', 'npsn');
    }
}
