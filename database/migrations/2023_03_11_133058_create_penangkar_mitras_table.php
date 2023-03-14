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
		Schema::create('penangkar_mitras', function (Blueprint $table) {
			$table->id();
			$table->BigInteger('penangkar_id')->nullable();
			$table->unsignedBigInteger('commitmentbackdate_id')->nullable();
			$table->string('no_ijin')->nullable();
			$table->string('varietas')->nullable();
			$table->string('ketersediaan')->nullable();
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
		Schema::dropIfExists('penangkar_mitras');
	}
};
