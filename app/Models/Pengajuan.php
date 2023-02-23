<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\RandomId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Auditable;
    use RandomId;

    
    public $table = 'pengajuans';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_doc',
        'detail',
        'jenis', // 1 = Pengajuan verifikasi ; 2 = verifikasi lolos; 3 = pengajuan SKL; 4 = SKL sudah terbit
        'status'
    ];
}
