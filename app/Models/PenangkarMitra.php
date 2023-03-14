<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class PenangkarMitra extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'penangkar_mitras';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $fillable = [
        'penangkar_id',
        'commitmentbackdate_id',
        'no_ijin',
        'varietas',
        'ketersediaan',
    ];

    public function commitmentbackdate()
    {
        return $this->belongsTo(CommitmentBackdate::class);
    }

    public function masterpenangkar()
    {
        return $this->belongsTo(MasterPenangkar::class, 'penangkar_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
