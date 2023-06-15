<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\GroupTani;

class Pks extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \Awobaz\Compoships\Compoships;

    public $table = 'pks';

    protected $fillable = [
        'npwp',
        'no_riph',
        'id_poktan',
        'no_perjanjian',
        'tgl_perjanjian_start',
        'tgl_perjanjian_end',
        'jumlah_anggota',
        'luas_rencana',
        'varietas_tanam',
        'periode_tanam',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'berkas_pks',
    ];

    public function groupTani(){
        return $this->hasMany(GroupTani::class, ['npwp', 'no_riph', 'id_poktan'], ['npwp', 'no_riph', 'id_poktan']);
    }

    public function petani(){
        return $this->hasMany(Poktan::class, ['npwp', 'no_riph', 'id_poktan'], ['npwp', 'no_riph', 'id_poktan']);
    }
}
