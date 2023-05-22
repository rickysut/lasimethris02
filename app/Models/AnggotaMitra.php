<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class AnggotaMitra extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'anggota_mitras';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $fillable = [
		'pks_mitra_id',
		'commitmentbackdate_id',
		'no_ijin',
		'master_anggota_id',
		'nama_lokasi',
		'latitude',
		'longitude',
		'altitude',
		'luas_kira',
		'polygon',
		'tgl_tanam',
		'luas_tanam',
		'varietas',
		'tgl_panen',
		'volume',
		'tanam_doc',
		'tanam_pict',
		'panen_doc',
		'panen_pict',
		'status',
	];

	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

	public function masterkelompok()
	{
		return $this->belongsTo(MasterKelompok::class);
	}

	public function pksmitra()
	{
		return $this->belongsTo(PksMitra::class, 'pks_mitra_id', 'id');
	}

	public function masteranggota()
	{
		return $this->belongsTo(MasterAnggota::class, 'master_anggota_id', 'id');
	}

	public function commitmentbackdate()
	{
		return $this->belongsTo(CommitmentBackdate::class, 'commitmentbackdate_id', 'id');
	}
}
