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
        Schema::create('backdate_skls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('periode', 4)->nullable();
            $table->string('no_ijin')->nullable();
            $table->string('no_skl')->nullable();
            $table->string('berkas_skl')->nullable();
            $table->string('berkas_dukung')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('backdate_skls');
    }
};
