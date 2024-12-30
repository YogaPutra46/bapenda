<?php

namespace App\Models;
  
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable 
{
    use HasFactory;

    protected $table = 'admins';
    protected $primaryKey='id_admin';

    protected $fillable = [
        'name', 'username', 'password', 'last_login_at', 'is_online'
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
    ];

    protected $guard = 'admin';  // Guard tambahan untuk memastikan menggunakan 'admin'
}
