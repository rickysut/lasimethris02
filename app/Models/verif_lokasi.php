<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verif_lokasi extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'verif_lokasis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'verif_at',
    ];

    protected $fillable = [
        'pengajuan_id',
        'verifcommit_id',
        'verifpks_id',
        'anggotamitra_id',

        // 'markerstatus',
        // 'polygonstatus',
        'datastatus',
        'onlinestatus',
        'onlinenote',
        'onlineverif_at',
        'onlineverificator_id',

        'latitude',
        'longitude',
        'altitude',
        'polygon',
        'luas_verif',
        'tgl_ukur',
        'volume_verif',
        'tgl_timbang',
        'onfarmstatus',
        'onfarmnote',
        'onfarmverif_at',
        'onfarmverificator_id',

    ];

    public function anggotamitra()
    {
        return $this->belongsTo(AnggotaMitra::class, 'anggotamitra_id', 'id');
    }

    public function verifpks()
    {
        return $this->belongsTo(verif_pksmitra::class, 'verifpks_id', 'id');
    }

    public function verifcommit()
    {
        return $this->belongsTo(verif_commitment::class, 'verifcommit_id', 'id');
    }

    public function pengajuanv2()
    {
        return $this->belongsTo(PengajuanV2::class, 'pengajuan_id', 'id');
    }
}
