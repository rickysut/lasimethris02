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
        Schema::create('pks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('npwp');
            $table->string('no_riph');
            $table->string('no_perjanjian');
            $table->date('tgl_perjanjian_start');
            $table->date('tgl_perjanjian_end');
            $table->integer('jumlah_anggota');
            $table->integer('luas_rencana');
            $table->string('varietas_tanam');
            $table->string('periode_tanam');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('berkas_pks');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('pks');
    }
};
