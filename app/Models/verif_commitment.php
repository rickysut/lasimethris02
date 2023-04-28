<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verif_commitment extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'verif_commitment';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'verif_at',
	];

	protected $fillable = [
		'pengajuan_id',
		'commitmentbackdate_id',
		'formRiph',
		'formSptjm',
		'logbook',
		'formRt',
		'formRta',
		'formRpo',
		'formLa',
		'status',
		'note',
		'verificator_id',
	];

	public function pengajuanv2()
	{
		return $this->belongsTo(PengajuanV2::class, 'pengajuan_id', 'id');
	}

	public function verifpks()
	{
		return $this->hasMany(verif_pksmitra::class);
	}
}
