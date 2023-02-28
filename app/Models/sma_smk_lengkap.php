<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sma_smk_lengkap extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kab_kotas()
    {
        return $this->belongsTo(kab_kota::class, 'kab_kota');
    }

    public function siswas()
    {
        return $this->hasMany(dataPokok::class, 'npsn_sekolah', 'npsn');
    }

    public function siswafix()
    {
        return $this->hasMany(siswaFix::class,'npsn_sma', 'npsn');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'npsn', 'npsn');
    }
}
