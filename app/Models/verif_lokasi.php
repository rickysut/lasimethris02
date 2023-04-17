<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verif_lokasi extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'verif_commitment';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'verif_at',
    ];

    protected $fillable = [
        'pengajuan_id',
        'commitmentbackdate_id',
        'pksmitra_id',
        'anggotamitra_id',
        'status_produksi',
        'status_tanam',
        'note',
        'verificator_id',
    ];
}
