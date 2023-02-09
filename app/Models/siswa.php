<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sekolahs()
    {
        return $this->belongsTo(sma_smk_lengkap::class, 'npsn', 'npsn');
    }

    public function nilai()
    {
        return $this->hasOne(nilai_siswa::class, 'siswa_id');
    }
}
