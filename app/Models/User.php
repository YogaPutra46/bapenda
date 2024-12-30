<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory;

    protected $guard = 'admin';
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';

    protected $fillable = ['nama_user', 'email',  'telepon', 'password'];

    public function permohonan()
    {
        return $this->hasMany(PermohonanPelayanan::class, 'user_id'); // sesuaikan dengan nama foreign key di tabel permohonan
    }
}
