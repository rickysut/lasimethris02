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
        Schema::create('poktans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_riph');
            $table->string('id_petani');
            $table->string('id_kabupaten')->nullable();
            $table->string('id_kecamatan')->nullable();
            $table->string('id_kelurahan')->nullable();
            $table->string('nama_kelompok')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->string('hp_pimpinan')->nullable();
            $table->string('nama_petani')->nullable();
            $table->string('ktp_petani')->nullable();
            $table->double('luas_lahan')->nullable();
            $table->string('periode_tanam')->nullable();
            $table->timestamps();
            $table->foreign('no_riph')
                ->references('no_ijin')
                ->on('pull_riphs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poktans');
    }
};
