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
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->string('no_ijin')->unique()->nullable();
			$table->string('periodetahun')->nullable();
			$table->string('tgl_ijin')->nullable();
			$table->string('tgl_akhir')->nullable();
			$table->string('no_hs')->nullable();
			$table->string('volume_riph')->nullable();
			$table->string('stok_mandiri')->nullable();
			$table->string('organik')->nullable();
			$table->string('npk')->nullable();
			$table->string('dolomit')->nullable();
			$table->string('za')->nullable();
			$table->string('poktan_share')->nullable();
			$table->string('importir_share')->nullable();
			$table->string('status')->nullable(); //null = un-accomplished, 1 = accomplished/lunas
			$table->string('formRiph')->nullable();
			$table->string('formSptjm')->nullable();
			$table->string('logbook')->nullable();
			$table->string('formRt')->nullable();
			$table->string('formRta')->nullable();
			$table->string('formRpo')->nullable();
			$table->string('formLa')->nullable();
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
