<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commitmentbackdate extends Model
{
	use HasFactory, SoftDeletes, Auditable;

	public $table = 'commitment_backdates';

	protected $fillable = [
		'user_id',
		'no_ijin',
		'periodetahun',
		'tgl_ijin',
		'tgl_akhir',
		'no_hs',
		'volume_riph',
		'stok_mandiri',
		'organik',
		'npk',
		'dolomit',
		'za',
		'mulsa',
		'poktan_share',
		'importir_share',
		'status',
		'formRiph',
		'formSptjm',
		'logbook',
		'formRt',
		'formRta',
		'formRpo',
		'formLa',
		'pengajuan_id',
		'no_pengajuan',
		'skl',
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function pksmitra()
	{
		return $this->hasMany(PksMitra::class);
	}

	public function penangkarmitra()
	{
		return $this->hasMany(PenangkarMitra::class);
	}

	public function pengajuanV2()
	{
		return $this->hasOne(PengajuanV2::class);
	}
}
