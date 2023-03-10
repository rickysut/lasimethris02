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
        Schema::create('master_anggotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_kelompok_id');
            $table->string('nama_petani')->nullable();
            $table->string('nik_petani')->unique()->nullable();
            $table->string('luas_lahan')->nullable();
            $table->string('periode_tanam')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('master_kelompok_id')->references('id')->on('master_kelompoks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_anggotas');
    }
};
