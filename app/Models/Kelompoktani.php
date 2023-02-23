<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelompoktani extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Auditable;

    public $table = 'kelompoktanis';

    protected $fillable = [
        'user_id',
        'cpcl_id',
        'no_poktan',
        'nama_poktan',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'jumlah_anggota',
        'luas_lahan',
        'alamat',
        'no_hp',
        'pimpinan'

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];



}
