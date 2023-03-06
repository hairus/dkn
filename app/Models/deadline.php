<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deadline extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kabs()
    {
        return $this->belongsTo(kab_kota::class, 'kab_id');
    }
}
