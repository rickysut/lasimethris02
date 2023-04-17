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
        Schema::create('verif_commitment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('commitmentbackdate_id');
            $table->enum('formRiph', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formSptjm', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('logBook', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formRt', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formRta', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formRpo', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formLa', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->string('status')->nullable()->nullable();
            $table->text('note')->nullable()->nullable();
            $table->date('verif_at')->nullable();
            $table->unsignedBigInteger('verificator_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pengajuan_id')->references('id')->on('pengajuan_v2s')->onDelete('cascade');

            $table->foreign('commitmentbackdate_id')->references('id')->on('commitment_backdates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verif_commitments');
    }
};
