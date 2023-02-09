<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sma_smk_lengkaps', function (Blueprint $table) {
            $table->id();
            $table->string('kode_un');
            $table->string('npsn');
            $table->string('nm_sekolah');
            $table->string('kab_kota');
            $table->string('jenjang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sma_smk_lengkaps');
    }
};
