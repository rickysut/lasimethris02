<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class MasterKelompok extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'master_kelompoks';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $fillable = [
		'user_id',
		'nama_kelompok',
		'nama_pimpinan',
		'hp_pimpinan',
		'id_provinsi',
		'id_kabupaten',
		'id_kecamatan',
		'id_kelurahan',
		'created_at',
		'updated_at',
	];

	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function masteranggota()
	{
		return $this->hasMany(MasterAnggota::class);
	}

	public function pksmitra()
	{
		return $this->hasMany(PksMitra::class, 'master_kelompok_id', 'id');
	}
}
