<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class MasterPenangkar extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'master_penangkars';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public $fillable = [
		'nama_lembaga',
		'alamat',
		'provinsi_id',
		'kabupaten_id',
		'kecamatan_id',
		'desa_id',
		'nama_pimpinan',
		'no_kontak',
	];

	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}
}
