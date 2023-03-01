<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poktan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Auditable;
    
    public $table = 'poktans';

    protected $fillable = [
        'no_riph',
        'id_petani',
        'id_kabupaten',
        'id_kecamatan',
        'id_kelurahan',
        'nama_kelompok',
        'nama_pimpinan',
        'hp_pimpinan',
        'nama_petani',
        'ktp_petani',
        'luas_lahan',
        'periode_tanam'
    ];
}
