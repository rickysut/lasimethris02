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
        Schema::dropIfExists('poktans');
        Schema::create('poktans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('npwp', 50);
            $table->string('no_riph');
            $table->string('id_petani')->unique();
            $table->string('id_poktan');
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
            $table->foreign('id_poktan')
                ->references('id_poktan')
                ->on('group_tanis')
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
