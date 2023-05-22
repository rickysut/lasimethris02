<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verif_pksmitra extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'verif_pksmitra';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'verif_at',
	];

	protected $fillable = [
		'pengajuan_id',
		'verifcommit_id',
		'pksmitra_id',
		'docstatus',
		'status',
		'note',
		'verificator_id',
	];

	public function pksmitra()
	{
		return $this->belongsTo(PksMitra::class, 'pksmitra_id', 'id');
	}

	public function pengajuanv2()
	{
		return $this->belongsTo(PengajuanV2::class, 'pengajuan_id', 'id');
	}

	public function verifcommit()
	{
		return $this->belongsTo(verif_commitment::class, 'verifcommit_id', 'id');
	}
}
