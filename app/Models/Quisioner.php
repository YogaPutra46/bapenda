<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quisioner extends Model
{
    use HasFactory;

    protected $table = 'tb_quisioner';
    protected $primaryKey = 'id_quisioner';
    protected $fillable = [
        'id_responden',
        'id_pelayanan',
        'id_penilaian',
    ];

    public function responden()
    {
        return $this->belongsTo(Responden::class, 'id_responden');
    }

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'id_pelayanan');
    }

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'id_penilaian');
    }
}
