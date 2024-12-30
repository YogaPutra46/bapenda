<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    use HasFactory;

    protected $table = 'tb_pelayanan';
    protected $primaryKey = 'id_pelayanan';
    protected $fillable = ['tempat_kerja', 'jenis_layanan'];

    public function quisioners()
    {
        return $this->hasMany(Quisioner::class, 'id_pelayanan');
    }
}
