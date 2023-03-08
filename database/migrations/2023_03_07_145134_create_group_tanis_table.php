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
        Schema::dropIfExists('group_tanis');
        Schema::create('group_tanis', function (Blueprint $table) {
            $table->id();
            $table->string('npwp', 50);
            $table->string('no_riph');
            $table->string('id_poktan')->unique();
            $table->string('id_kabupaten')->nullable();
            $table->string('id_kecamatan')->nullable();
            $table->string('id_kelurahan')->nullable();
            $table->string('nama_kelompok')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->string('hp_pimpinan')->nullable();
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
        Schema::dropIfExists('group_tanis');
    }
};
