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
		'no_perjanjian',
		'tgl_perjanjian_start',
		'tgl_perjanjian_end',
		'jumlah_anggota',
		'luas_rencana',
		'varietas_tanam',
		'periode_tanam',
		'provinsi_id',
		'kabupaten_id',
		'kecamatan_id',
		'kelurahan_id',
		'berkas_pks',
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

	public function provinsi()
	{
		return $this->belongsTo(MasterProvinsi::class, 'provinsi_id', 'provinsi_id');
	}

	public function kabupaten()
	{
		return $this->belongsTo(MasterKabupaten::class, 'kabupaten_id', 'kabupaten_id');
	}

	public function kecamatan()
	{
		return $this->belongsTo(MasterKecamatan::class, 'kecamatan_id', 'kecamatan_id');
	}

	public function desa()
	{
		return $this->belongsTo(MasterDesa::class, 'kelurahan_id', 'kelurahan_id');
	}
}
