<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTani extends Model
{
    use HasFactory;
    use Auditable;
    use \Awobaz\Compoships\Compoships;

    public $table = 'group_tanis';

    protected $fillable = [

        'npwp',
        'no_riph',
        'id_poktan',
        'id_kabupaten',
        'id_kecamatan',
        'id_kelurahan',
        'nama_kelompok',
        'nama_pimpinan',
        'hp_pimpinan'
    ];

}
