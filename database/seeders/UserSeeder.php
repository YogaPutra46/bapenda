<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'nama_user' => 'Administrator',
            'email' => 'admin@gmail.com',
            'telepon' => '087087087087',
            'password' => Hash::make('admin'),
        ]);
        User::insert([
            'nama_user' => 'User',
            'email' => 'user@gmail.com',
            'telepon' => '087087087087',
            'password' => Hash::make('user'),
        ]);
    }
}
