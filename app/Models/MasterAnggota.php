<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterAnggota extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'master_anggotas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'master_kelompok_id',
        'nama_petani',
        'nik_petani',
        'luas_lahan',
        'periode_tanam',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function masterkelompok()
    {
        return $this->belongsTo(MasterKelompok::class);
    }
}
