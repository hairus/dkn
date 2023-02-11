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
        Schema::create('siswa_fixes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('npsn_sma');
            $table->string('nisn');
            $table->string('tingkat');
            $table->string('npsn_smp');
            $table->string('rombel');
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
        Schema::dropIfExists('siswa_fixes');
    }
};
