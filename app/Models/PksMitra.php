<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class PksMitra extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'pks_mitras';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $fillable = [
		'commitmentbackdate_id',
		'master_kelompok_id',
		'no_ijin',
		'no_pks',
		'tgl_mulai',
		'tgl_akhir',
		'luas_rencana',
		'varietas',
		'periode_tanam',
		'provinsi_id',
		'kabupaten_id',
		'kecamatan_id',
		'kelurahan_id',
		'attachment',
		'status',
	];

	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

	public function commitmentbackdate()
	{
		return $this->belongsTo(CommitmentBackdate::class);
	}

	public function masterkelompok()
	{
		return $this->belongsTo(MasterKelompok::class, 'master_kelompok_id', 'id');
	}

	public function anggotamitras()
	{
		return $this->hasMany(AnggotaMitra::class, 'pks_mitra_id', 'id');
	}
}
