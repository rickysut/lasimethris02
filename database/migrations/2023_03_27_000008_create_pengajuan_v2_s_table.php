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
		Schema::create('pengajuan_v2s', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('commitmentbackdate_id');
			$table->string('no_pengajuan');
			$table->enum('jenis', ['Verifikasi', 'SKL'])->nullable(); //Verifikasi, SKL
			$table->string('status')->nullable(); //1 Diajukan, 2 Diperiksa, 3 Selesai-, 4 Selesai+
			$table->text('note')->nullable();
			$table->string('onlinestatus')->nullable();
			$table->text('onlinenote')->nullable();
			$table->date('onlinedate')->nullable();
			$table->string('onlineattch')->nullable();
			$table->bigInteger('onlineverificator')->nullable();
			$table->string('onfarmstatus')->nullable();
			$table->text('onfarmnote')->nullable();
			$table->date('onfarmdate')->nullable();
			$table->string('onfarmattch')->nullable();
			$table->bigInteger('onfarmverificator')->nullable();
			$table->date('verif_at')->nullable();
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
		Schema::dropIfExists('pengajuan_v2s');
	}
};
