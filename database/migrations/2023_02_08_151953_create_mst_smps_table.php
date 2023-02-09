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
        Schema::create('mst_smps', function (Blueprint $table) {
            $table->id();
            $table->string('kode_un');
            $table->string('npsn_smp');
            $table->string('nama_smp');
            $table->unsignedBigInteger('kab_id');
            $table->string('jenjang');
            $table->foreign('kab_id')->references('id')->on('kab_kotas')->onDelete('cascade');
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
        Schema::dropIfExists('mst_smps');
    }
};
