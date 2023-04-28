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
		Schema::create('verif_lokasis', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('pengajuan_id');
			$table->unsignedBigInteger('verifcommit_id');
			$table->unsignedBigInteger('verifpks_id');
			$table->unsignedBigInteger('anggotamitra_id');
			//diisi oleh online verifikator
			// $table->enum('markerstatus', ['Ada', 'Tidak Ada'])->nullable();
			// $table->enum('polygonstatus', ['Ada', 'Tidak Ada'])->nullable();
			$table->enum('datastatus', ['Sesuai', 'Tidak Sesuai'])->nullable();
			$table->string('onlinestatus')->nullable(); //
			$table->text('onlinenote')->nullable();
			$table->date('onlineverif_at')->nullable();
			$table->unsignedBigInteger('onlineverificator_id')->nullable();

			//diisi oleh onfarm verifikator, data geolokasi
			$table->text('latitude')->nullable();
			$table->text('longitude')->nullable();
			$table->text('altitude')->nullable();
			$table->text('polygon')->nullable();

			//data tanam
			$table->string('luas_verif')->nullable();
			$table->string('tgl_ukur')->nullable();

			//data produksi
			$table->string('volume_verif')->nullable();
			$table->string('tgl_timbang')->nullable();


			$table->string('onfarmstatus')->nullable(); //selesai atau 3
			$table->text('onfarmnote')->nullable();
			$table->date('onfarmverif_at')->nullable();
			$table->date('onfarmverificator_id')->nullable();
			$table->softDeletes();
			$table->timestamps();

			$table->foreign('pengajuan_id')->references('id')->on('pengajuan_v2s')->onDelete('cascade');

			$table->foreign('verifcommit_id')->references('id')->on('verif_commitment')->onDelete('cascade');

			$table->foreign('verifpks_id')->references('id')->on('verif_pksmitra')->onDelete('cascade');

			$table->foreign('anggotamitra_id')->references('id')->on('anggota_mitras')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('verif_lokasis');
	}
};
