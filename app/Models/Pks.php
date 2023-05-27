<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pks extends Model
{
    use HasFactory;
    use SoftDeletes;

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
}
