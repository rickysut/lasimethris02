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
		Schema::create('sklv2s', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('pengajuan_id');
			$table->string('no_skl')->nullable();
			$table->date('published_date')->nullable();
			$table->string('qrcode')->nullable();
			$table->text('nota_attch')->nullable();
			$table->unsignedBigInteger('publisher')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('pengajuan_id')->references('id')->on('pengajuan_v2s')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('skl_v2_s');
	}
};
