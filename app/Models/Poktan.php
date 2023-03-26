<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poktan extends Model
{
    use HasFactory;
    use Auditable;
    
    public $table = 'poktans';

    protected $fillable = [
        'npwp',
        'no_riph',
        'id_petani',
        'id_poktan',
        'nama_petani',
        'ktp_petani',
        'luas_lahan',
        'periode_tanam'
    ];
}
