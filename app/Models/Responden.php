<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responden extends Model
{
    use HasFactory;

    protected $table = 'tb_responden';
    protected $primaryKey = 'id_responden';
    protected $fillable = ['gender', 'age', 'education', 'employment'];

    public function quisioners()
    {
        return $this->hasMany(Quisioner::class, 'id_responden');
    }
}
