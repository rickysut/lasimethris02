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
        Schema::create('verif_pksmitra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('verifcommit_id');
            $table->unsignedBigInteger('pksmitra_id');
            $table->enum('docstatus', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->date('verif_at')->nullable();
            $table->unsignedBigInteger('verificator_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pengajuan_id')->references('id')->on('pengajuan_v2s')->onDelete('cascade');

            $table->foreign('verifcommit_id')->references('id')->on('verif_commitment')->onDelete('cascade');

            $table->foreign('pksmitra_id')->references('id')->on('pks_mitras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verif_pksmitras');
    }
};
