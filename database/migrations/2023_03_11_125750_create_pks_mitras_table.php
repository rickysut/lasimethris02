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
			$table->id();
			$table->unsignedBigInteger('commitmentbackdate_id');
			$table->bigInteger('master_kelompok_id')->nullable();
			$table->string('no_ijin')->nullable();
			$table->string('no_pks')->nullable();
			$table->string('tgl_mulai')->nullable();
			$table->string('tgl_akhir')->nullable();
			$table->string('luas_rencana')->nullable();
			$table->string('varietas')->nullable();
			$table->string('periode_tanam')->nullable();
			$table->string('provinsi_id')->nullable();
			$table->string('kabupaten_id')->nullable();
			$table->string('kecamatan_id')->nullable();
			$table->string('kelurahan_id')->nullable();
			$table->string('attachment')->nullable();
			$table->string('status')->nullable();
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
