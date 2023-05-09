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
		'note',
		'luas_verif',
		'volume_verif',
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

	public function sklv2()
	{
		return $this->belongsTo(Sklv2::class, 'id', 'pengajuan_id');
	}
}
