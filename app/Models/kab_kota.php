<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kab_kota extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sekolahs()
    {
        return $this->hasMany(sma_smk_lengkap::class, 'kab_kota', 'id');
    }

    public function deadline_kab_kota()
    {
        return $this->hasOne(deadline_kab_kota::class, 'kab_kota', 'id');
    }
}
