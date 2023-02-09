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
        Schema::create('data_pokoks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_sekolah');
            $table->string('npsn_sekolah');
            $table->string('nisn');
            $table->string('tingkat');
            $table->string('asal_sekolah');
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
        Schema::dropIfExists('data_pokoks');
    }
};
