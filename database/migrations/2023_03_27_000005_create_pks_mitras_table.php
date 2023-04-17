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
		Schema::create('pks_mitras', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('commitmentbackdate_id');
			$table->bigInteger('master_kelompok_id')->nullable();
			$table->string('no_ijin')->nullable();
			$table->string('no_perjanjian')->nullable();
			$table->date('tgl_perjanjian_start')->nullable();
			$table->date('tgl_perjanjian_end')->nullable();
			$table->integer('jumlah_anggota')->nullable();
			$table->integer('luas_rencana')->nullable();
			$table->string('varietas_tanam')->nullable();
			$table->string('periode_tanam')->nullable();
			$table->string('provinsi_id')->nullable();
			$table->string('kabupaten_id')->nullable();
			$table->string('kecamatan_id')->nullable();
			$table->string('kelurahan_id')->nullable();
			$table->string('berkas_pks')->nullable();
			$table->string('pengajuan_id')->nullable();
			$table->integer('status')->nullable();
			$table->timestamps();
			$table->softDeletes();

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
		Schema::dropIfExists('pks_mitras');
	}
};
