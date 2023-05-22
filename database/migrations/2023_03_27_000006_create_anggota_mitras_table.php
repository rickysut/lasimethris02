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
		Schema::create('anggota_mitras', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('pks_mitra_id');
			$table->unsignedBigInteger('commitmentbackdate_id');
			$table->string('no_ijin');
			$table->unsignedBigInteger('master_anggota_id');
			$table->string('nama_lokasi')->nullable();
			$table->decimal('latitude', 10, 8)->nullable();
			$table->decimal('longitude', 10, 8)->nullable();
			$table->double('altitude')->nullable();
			$table->decimal('luas_kira', 10, 2)->nullable();
			$table->string('polygon')->nullable();
			$table->date('tgl_tanam')->nullable();
			$table->float('luas_tanam')->nullable();
			$table->string('varietas')->nullable();
			$table->date('tgl_panen')->nullable();
			$table->double('volume')->nullable();
			$table->string('tanam_doc')->nullable();
			$table->string('tanam_pict')->nullable();
			$table->string('panen_doc')->nullable();
			$table->string('panen_pict')->nullable();
			$table->string('pengajuan_id')->nullable();
			$table->integer('status')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('commitmentbackdate_id')->references('id')->on('commitment_backdates')->onDelete('cascade');
			$table->foreign('no_ijin')->references('no_ijin')->on('commitment_backdates')->onDelete('cascade');
			$table->foreign('pks_mitra_id')->references('id')->on('pks_mitras')->onDelete('cascade');
			$table->foreign('master_anggota_id')->references('id')->on('master_anggotas')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('anggota_mitras');
	}
};
