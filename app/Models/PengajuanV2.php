<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanV2 extends Model
{
	use HasFactory, SoftDeletes, Auditable;

	public $table = 'pengajuan_v2s';

	protected $fillable = [
		'commitmentbackdate_id',
		'no_pengajuan',
		'jenis',
		'status',
		'onlinestatus',
		'onlinenote',
		'onlinedate',
		'onlineattch',
		'onlineverificator',
		'onfarmstatus',
		'onfarmnote',
		'onfarmdate',
		'onfarmattch',
		'onfarmverificator',
		'note',
		'verif_at',
	];

	public function commitmentbackdate()
	{
		return $this->belongsTo(CommitmentBackdate::class, 'commitmentbackdate_id', 'id');
	}

	public function verifcommitment()
	{
		return $this->hasOne(verif_commitment::class);
	}
}
