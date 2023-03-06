<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deadline_kab_kota extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kab_kotas()
    {
        return $this->belongsTo(kab_kota::class, 'kab_kota');
    }
}
