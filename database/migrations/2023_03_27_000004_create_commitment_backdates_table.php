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
		Schema::create('commitment_backdates', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->string('npwp')->nullable();
			$table->string('no_ijin')->unique()->nullable();
			$table->integer('periodetahun')->nullable();
			$table->date('tgl_ijin')->nullable();
			$table->date('tgl_akhir')->nullable();
			$table->string('no_hs')->nullable();
			$table->double('volume_riph', 8, 2)->nullable();
			$table->double('stok_mandiri', 8, 2)->nullable();
			$table->double('organik', 8, 2)->nullable();
			$table->double('npk', 8, 2)->nullable();
			$table->double('dolomit', 8, 2)->nullable();
			$table->double('za', 8, 2)->nullable();
			$table->double('mulsa', 8, 2)->nullable();
			$table->integer('poktan_share')->nullable();
			$table->integer('importir_share')->nullable();
			$table->integer('status')->nullable(); //null = un-accomplished, 1 = accomplished/lunas
			$table->string('formRiph')->nullable();
			$table->string('formSptjm')->nullable();
			$table->string('logbook')->nullable();
			$table->string('formRt')->nullable();
			$table->string('formRta')->nullable();
			$table->string('formRpo')->nullable();
			$table->string('formLa')->nullable();
			$table->unsignedBigInteger('pengajuan_id')->nullable();
			$table->string('no_pengajuan')->nullable();
			$table->string('SKL')->nullable();
			$table->timestamps();
			$table->softDeletes()->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('commitment_backdates');
	}
};
