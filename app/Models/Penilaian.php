<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'tb_penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $fillable = [
        'soal1_A',
        'soal2_A',
        'soal3_A',
        'soal4_A',
        'soal5_A',
        'soal6_A',
        'soal7_A',
        'soal8_A',
        'soal1_B',
        'soal2_B',
        'soal3_B',
        'soal4_B',
        'soal5_B',
        'komentar'
    ];

    public function quisioners()
    {
        return $this->hasMany(Quisioner::class, 'id_penilaian');
    }
}
