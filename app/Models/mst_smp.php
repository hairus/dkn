<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mst_smp extends Model
{
    use HasFactory;

    public function kabs()
    {
        return $this->belongsTo(kab_kota::class, 'kab_id');
    }
}
