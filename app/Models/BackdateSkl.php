<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BackdateSkl extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'backdate_skls';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'periode',
        'no_ijin',
        'no_skl',
        'berkas_skl',
        'berkas_dukung',
    ];
}
